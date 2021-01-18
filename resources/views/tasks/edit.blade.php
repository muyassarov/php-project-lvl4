@extends('layouts.app')

@section('title', __('views.task.edit.title'))

@section('content')
    <h2>{{ __('views.task.edit.title') }}</h2>
    {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'put']) }}
    {{ Form::bsText('name', $task->name, __('forms.task.edit.name-label'), ['placeholder' => __('forms.task.edit.name-placeholder'), 'required', 'autofocus']) }}
    {{ Form::bsTextarea('description', $task->description, __('forms.task.edit.description-label'), ['placeholder' => __('forms.task.edit.description-placeholder'), 'rows' => 2]) }}
    {{ Form::bsSelect('status_id', $taskStatuses, $task->status_id, __('forms.task.edit.status-label'), ['required']) }}
    {{ Form::bsSelect('assignee_to_id', $users, $task->assigned_to_id, __('forms.task.edit.assigned-to-label'), ['placeholder' => __('forms.task.edit.assigned-to-placeholder')]) }}
    {{ Form::bsSelect('labels[]', $labels, $task->labels->pluck('id'), __('forms.task.edit.labels-label'), ['multiple']) }}
    {{ link_to_route('tasks.index', __('forms.task.edit.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task.edit.submit-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
