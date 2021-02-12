<?php

namespace App\Http\Controllers;

use App\Models\{Label, Task, TaskStatus, User};
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Validator};
use Spatie\QueryBuilder\{AllowedFilter, QueryBuilder};

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    public function index()
    {
        $tasks = QueryBuilder::for(Task::class)->allowedFilters([
            AllowedFilter::exact('status_id'),
            AllowedFilter::exact('assigned_to_id'),
            AllowedFilter::exact('created_by_id'),
        ])->allowedIncludes([
            'status',
            'creator',
            'assignee',
        ])->orderBy('created_at', 'desc')->get();

        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $users        = User::all()->pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'taskStatuses', 'users'));
    }

    public function create()
    {
        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $users        = User::all()->pluck('name', 'id');
        $labels       = Label::all()->pluck('name', 'id');
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

        flash(__('flash.task.store.success'))->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $users        = User::all()->pluck('name', 'id');
        $labels       = Label::all()->pluck('name', 'id');

        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels'));
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
        $labels = collect($request->get('labels'))->filter(function ($value) {
            return (bool)$value;
        });
        $task->fill([
            'name'           => $request->get('name'),
            'description'    => $request->get('description'),
            'status_id'      => $request->get('status_id'),
            'assigned_to_id' => $request->get('assigned_to_id'),
        ]);
        $task->save();
        if ($labels->count()) {
            $task->labels()->sync($labels->toArray());
        } else {
            $task->labels()->detach();
        }

        flash(__('flash.task.update.success'))->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->labels()->detach();
        $task->delete();
        flash(__('flash.task.destroy.success'))->success();
        return redirect()->route('tasks.index');
    }
}
