<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Validation\Rule;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    public function index()
    {
        $taskStatuses = TaskStatus::orderBy('created_at', 'desc')->get();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        return view('task_statuses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:App\Models\TaskStatus,name',
        ]);
        $taskStatus       = new TaskStatus();
        $taskStatus->name = $request->post('name');
        $taskStatus->save();

        flash(__('flash.taskStatus.store.success'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function show(TaskStatus $taskStatus)
    {
        return view('task_statuses.show', compact('taskStatus'));
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus): RedirectResponse
    {
        $this->validate($request, [
            'name' => [
                'required',
                'min:2',
                Rule::unique(TaskStatus::class)->ignore($taskStatus->id),
            ],
        ]);

        $taskStatus->name = $request->get('name');
        $taskStatus->save();

        flash(__('flash.taskStatus.update.success'))->success();
        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->delete();
        flash(__('flash.taskStatus.destroy.success'))->success();
        return redirect()->route('task_statuses.index');
    }
}
