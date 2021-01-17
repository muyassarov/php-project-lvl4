@extends('layouts.app')

@section('title', __('views.task.edit.title'))

@section('content')
    <h2>{{ __('views.task.edit.title') }}</h2>
    {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'put']) }}
    <div class="form-group">
        {{ Form::label('name', __('forms.task.edit.name-label')) }}
        {{ Form::text('name', $task->name, ['class' => 'form-control', 'placeholder' => __('forms.task.edit.name-placeholder'), 'required', 'autofocus']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', __('forms.task.edit.description-label')) }}
        {{ Form::textarea('description', $task->description, ['class' => 'form-control', 'placeholder' => __('forms.task.edit.description-placeholder'), 'rows' => 2]) }}
    </div>
    <div class="form-group">
        {{ Form::label('status_id', __('forms.task.edit.status-label')) }}
        {{ Form::select('status_id', $taskStatuses, $task->status_id, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group">
        {{ Form::label('assignee_to_id', __('forms.task.edit.assigned-to-label')) }}
        {{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['class' => 'form-control', 'placeholder' => __('forms.task.edit.assigned-to-placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label('labels', __('forms.task.edit.labels-label')) }}
        {{ Form::select('labels[]', $labels, $task->labels->pluck('id'), ['class' => 'form-control', 'multiple']) }}
    </div>
    {{ link_to_route('tasks.index', __('forms.task.edit.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task.edit.submit-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
