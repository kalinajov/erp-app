<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // ✅ INDEX WITH FILTER + SEARCH
    public function index(Request $request)
    {
        $query = Task::query();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // FILTER PRIORITY
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = 'todo';
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->estimated_hours = $request->estimated_hours;
        $task->user_id = auth()->id();

        $task->save();

        // Assign user ако има избрано
        if ($request->user_id) {
            $task->users()->attach($request->user_id);
        }

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status ?? 'todo';
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->estimated_hours = $request->estimated_hours;

        $task->save();

        // Update assign user
        if ($request->user_id) {
            $task->users()->sync([$request->user_id]);
        }

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}