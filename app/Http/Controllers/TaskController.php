<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\Console\Input\Input;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)->allowedFilters([
                'status_id',
                'assigned_to_id',
                'created_by_id',
            ])->allowedIncludes([
                'status',
                'creator',
                'assignee',
            ])->orderBy('created_at', 'desc')->get();

        $taskStatuses = TaskStatus::all();
        $users        = User::all();
        return view('tasks.index', compact('tasks', 'taskStatuses', 'users'));
    }

    public function create()
    {
        $taskStatuses = TaskStatus::all();
        $users        = User::all();
        $labels       = Label::all();
        return view('tasks.create', compact('taskStatuses', 'users', 'labels'));
    }

    public function store(Request $request): RedirectResponse
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

        $labels = $request->get('labels');
        $task   = new Task([
            'name'           => $request->get('name'),
            'description'    => $request->get('description'),
            'status_id'      => $request->get('status_id'),
            'assigned_to_id' => $request->get('assigned_to_id'),
            'created_by_id'  => Auth::id(),
        ]);
        $task->save();

        if ($labels) {
            $task->labels()->attach($labels);
        }

        flash(__('tasks.create-success-msg'))->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $taskStatuses  = TaskStatus::all();
        $users         = User::all();
        $labels        = Label::all();
        $taskLabels    = $task->labels()->get();
        $taskLabelsIds = $taskLabels->pluck('id')->toArray();

        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels', 'taskLabelsIds'));
    }

    public function update(Request $request, Task $task): RedirectResponse
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

        $labels = $request->get('labels');
        $task->fill([
            'name'           => $request->get('name'),
            'description'    => $request->get('description'),
            'status_id'      => $request->get('status_id'),
            'assigned_to_id' => $request->get('assigned_to_id'),
        ]);
        if ($labels) {
            $task->labels()->sync($labels);
        }
        $task->save();

        flash(__('tasks.update-success-msg'))->success();
        return redirect()->route('tasks.edit', $task);
    }

    public function destroy(Task $task): RedirectResponse
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
