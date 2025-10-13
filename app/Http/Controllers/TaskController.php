<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\TaskCreated; // 1. Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Menampilkan dashboard dengan statistik dan daftar tugas.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil semua tugas milik user
        $tasks = $user->tasks()->orderBy('deadline', 'asc')->get();

        // Menghitung statistik
        $totalTugas = $tasks->count();
        $tugasSelesai = $tasks->where('status', 'Selesai')->count();
        $tugasBelumDikerjakan = $totalTugas - $tugasSelesai;
        $tugasMendekatiDeadline = $tasks->where('status', '!=', 'Selesai')
                                       ->where('deadline', '<=', Carbon::now()->addDays(3))
                                       ->count();

        // Mengirim semua data ke view
        return view('dashboard', compact(
            'tasks', 
            'totalTugas', 
            'tugasSelesai', 
            'tugasBelumDikerjakan', 
            'tugasMendekatiDeadline'
        ));
    }

    /**
     * Menampilkan form untuk menambah tugas baru.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Menyimpan tugas baru ke database dan mengirim notifikasi.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'deadline' => 'required|date',
            'deskripsi' => 'nullable|string',
            'prioritas' => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
        ]);

        // 2. Simpan data dan dapatkan instance tugas yang baru dibuat
        $task = Auth::user()->tasks()->create($request->all());

        // 3. Kirim notifikasi email ke user yang sedang login
        Auth::user()->notify(new TaskCreated($task));

        // 4. Redirect dengan pesan sukses yang baru
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan & notifikasi telah dikirim!');
    }

    /**
     * Menampilkan detail satu tugas.
     */
    public function show(Task $task)
    {
        return redirect()->route('tasks.edit', $task);
    }

    /**
     * Menampilkan form untuk mengedit tugas.
     */
    public function edit(Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Akses Ditolak');
        }
        
        return view('tasks.edit', compact('task'));
    }

    /**
     * Memperbarui tugas yang ada di database.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'deadline' => 'required|date',
            'deskripsi' => 'nullable|string',
            'status' => ['required', Rule::in(['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'])],
            'prioritas' => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
        ]);

        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Menghapus tugas dari database.
     */
    public function destroy(Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Akses Ditolak');
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil dihapus!');
    }
    
    /**
     * Memperbarui status tugas langsung dari dashboard.
     */
    public function updateStatus(Request $request, Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'status' => ['required', Rule::in(['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'])],
        ]);
        
        $task->update(['status' => $request->status]);

        return redirect()->route('dashboard')->with('success', 'Status tugas berhasil diperbarui!');
    }
}