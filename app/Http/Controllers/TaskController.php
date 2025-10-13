<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Notifications\TaskCreated;

class TaskController extends Controller
{
    /**
     * Menampilkan dashboard dengan statistik dan daftar tugas.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $tasksQuery = $user->tasks();

        if ($request->has('status') && in_array($request->status, ['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'])) {
            $tasksQuery->where('status', $request->status);
        }

        if ($request->get('sort') == 'priority_desc') {
            $tasksQuery->orderByRaw("FIELD(prioritas, 'Tinggi', 'Sedang', 'Rendah') ASC");
        } else {
            $tasksQuery->orderBy('deadline', 'asc');
        }
        
        $tasks = $tasksQuery->get();

        $allTasks = $user->tasks()->get();
        $totalTugas = $allTasks->count();
        $tugasSelesai = $allTasks->where('status', 'Selesai')->count();
        $tugasBelumDikerjakan = $totalTugas - $tugasSelesai;
        $tugasMendekatiDeadline = $allTasks->where('status', '!=', 'Selesai')
                                       ->where('deadline', '<=', Carbon::now()->addDays(3))
                                       ->count();

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

        $task = Auth::user()->tasks()->create($request->all());
        Auth::user()->notify(new TaskCreated($task));

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman detail satu tugas.
     */
    public function show(Task $task)
    {
        // Pastikan user hanya bisa melihat tugas miliknya
        if (Auth::id() !== $task->user_id) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
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
            'deadline' => 'required|date_format:Y-m-d\TH:i',
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

    /**
     * Mengambil data tugas untuk ditampilkan di kalender.
     */
    public function tasksForCalendar(Request $request)
    {
        $tasks = Auth::user()->tasks()->get();
        $events = [];

        foreach ($tasks as $task) {
            $backgroundColor = '';
            switch ($task->prioritas) {
                case 'Tinggi': $backgroundColor = '#EF4444'; break;
                case 'Sedang': $backgroundColor = '#F59E0B'; break;
                case 'Rendah': $backgroundColor = '#10B981'; break;
            }

            $endDate = Carbon::parse($task->deadline)->addDay()->format('Y-m-d');

            $events[] = [
                'id' => $task->id,
                'title' => $task->nama_tugas,
                'start' => $task->deadline,
                'end' => $endDate,
                'allDay' => true,
                'backgroundColor' => $backgroundColor,
                'borderColor' => $backgroundColor,
                'url' => route('tasks.show', $task->id), // Diarahkan ke show
                'extendedProps' => [
                    'mata_kuliah' => $task->mata_kuliah,
                    'prioritas' => $task->prioritas,
                    'status' => $task->status,
                ]
            ];
        }

        return response()->json($events);
    }
}