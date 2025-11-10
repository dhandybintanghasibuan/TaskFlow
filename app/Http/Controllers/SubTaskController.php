<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SubTaskNotification; 

class SubTaskController extends Controller
{
    public function store(Request $request, Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403);
        }
        $request->validate(['deskripsi' => 'required|string|max:255']);
        $subTask = $task->subTasks()->create($request->all());

        
        Auth::user()->notify(new SubTaskNotification($subTask, 'created'));

        return back()->with('success', 'Checklist berhasil ditambahkan!');
    }

    public function update(Request $request, SubTask $subTask)
    {
        if (Auth::id() !== $subTask->task->user_id) {
            abort(403);
        }
        $subTask->update(['is_completed' => $request->boolean('is_completed')]);

     
        if ($subTask->is_completed) {
            Auth::user()->notify(new SubTaskNotification($subTask, 'completed'));
        }

        return back()->with('success', 'Checklist diperbarui!');
    }

    public function destroy(SubTask $subTask)
    {
        if (Auth::id() !== $subTask->task->user_id) {
            abort(403);
        }
        $subTask->delete();

        return back()->with('success', 'Checklist dihapus!');
    }
}
