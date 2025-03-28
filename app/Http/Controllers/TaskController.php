<?php

namespace App\Http\Controllers;

use App\Events\CompleteTask;
use App\Models\Tasks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Tasks::latest()->paginate(20);
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $task = new Tasks();
        $task->name = $request->input('name');
        $task->completed  = false;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function complete(Tasks $task): \Illuminate\Http\RedirectResponse
    {
        $task->completed = true;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Tasks::destroy($id);
        return redirect()->route('tasks.index');
    }
}
