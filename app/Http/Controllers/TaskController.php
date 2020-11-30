<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $taskStatuses = TaskStatus::all();
        $users        = User::all();
        return view('tasks.create', compact('taskStatuses', 'users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|min:4',
            'status_id'      => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->route('tasks.create')->withInput();
        }

        $task = new Task([
            'name'           => $request->get('name'),
            'description'    => $request->get('description'),
            'status_id'      => $request->get('status_id'),
            'assigned_to_id' => $request->get('assigned_to_id'),
            'created_by_id'  => Auth::id(),
        ]);
        $task->save();

        flash(__('tasks.create-success-msg'))->success();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $users        = User::all();
        return view('tasks.edit', compact('task', 'taskStatuses', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|min:4',
            'status_id'      => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->route('tasks.edit', $task)->withInput();
        }

        $task->fill([
            'name'           => $request->get('name'),
            'description'    => $request->get('description'),
            'status_id'      => $request->get('status_id'),
            'assigned_to_id' => $request->get('assigned_to_id'),
        ]);
        $task->save();

        flash(__('tasks.update-success-msg'))->success();
        return redirect()->route('tasks.edit', $task);
    }

    public function destroy(Task $task)
    {
        if ($task->created_by_id != Auth::id()) {
            flash(__('tasks.destroy-permission-error-msg'))->error();
            return redirect()->route('tasks.index');
        }
        $task->delete();
        flash(__('tasks.destroy-success-msg'))->success();
        return redirect()->route('tasks.index');
    }
}
