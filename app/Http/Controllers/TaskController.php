<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Notifications\TaskCreated;
use App\Notifications\TaskUpdated;
use Illuminate\Database\Eloquent\Collection;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tasksQuery = $user->tasks();

        if ($request->filled('status')) {
            $tasksQuery->where('status', $request->status);
        }
        if ($request->filled('prioritas')) {
            $tasksQuery->where('prioritas', $request->prioritas);
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

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'deadline' => 'required|date_format:Y-m-d H:i|after_or_equal:today',
            'deskripsi' => 'nullable|string',
            'prioritas' => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
        ]);
        $task = Auth::user()->tasks()->create($request->all());
        Auth::user()->notify(new TaskCreated($task));
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function show(Task $task)
{
    if (Auth::id() !== $task->user_id) {
        abort(403);
    }

    // Memuat sub-tugas yang terhubung dengan tugas ini
    $task->load('subTasks');

    return view('tasks.show', compact('task'));
}

    public function edit(Task $task)
    {
        if (Auth::id() !== $task->user->id) {
            abort(403, 'Akses Ditolak');
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if (Auth::id() !== $task->user->id) {
            abort(403, 'Akses Ditolak');
        }
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'mata_kuliah' => 'required|string|max:255',
            'deadline' => 'required|date_format:Y-m-d H:i|after_or_equal:today',
            'deskripsi' => 'nullable|string',
            'status' => ['required', Rule::in(['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'])],
            'prioritas' => ['required', Rule::in(['Rendah', 'Sedang', 'Tinggi'])],
        ]);
        $task->update($request->all());
        Auth::user()->notify(new TaskUpdated($task));
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Akses Ditolak');
        }
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Tugas dipindahkan ke tong sampah!');
    }
    
    public function updateStatus(Request $request, Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Akses Ditolak');
        }
        $request->validate(['status' => ['required', Rule::in(['Belum Dikerjakan', 'Sedang Dikerjakan', 'Selesai'])]]);
        $task->update(['status' => $request->status]);
        return redirect()->route('dashboard')->with('success', 'Status tugas berhasil diperbarui!');
    }

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
                'url' => route('tasks.show', $task->id),
                'extendedProps' => [
                    'mata_kuliah' => $task->mata_kuliah,
                    'prioritas' => $task->prioritas,
                    'status' => $task->status,
                ]
            ];
        }
        return response()->json($events);
    }

    public function trash()
    {
        $trashedTasks = Auth::user()->tasks()->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('tasks.trash', compact('trashedTasks'));
    }

    public function restore($id)
    {
        $task = Auth::user()->tasks()->onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.trash')->with('success', 'Tugas berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        $task = Auth::user()->tasks()->onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('tasks.trash')->with('success', 'Tugas berhasil dihapus permanen!');
    }
}