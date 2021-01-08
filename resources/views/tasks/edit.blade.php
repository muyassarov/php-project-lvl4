@extends('layouts.app')

@section('title', __('tasks.update-title'))

@section('content')
    <h2>{{ __('tasks.update-title') }}</h2>
    {!! Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::label('name', __('tasks.label-name')) !!}
        {!! Form::text('name', $task->name, ['class' => 'form-control', 'placeholder' => __('tasks.task-name-placeholder'), 'required', 'autofocus']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', __('tasks.label-description')) !!}
        {!! Form::textarea('description', $task->description, ['class' => 'form-control', 'placeholder' => __('tasks.task-description-placeholder'), 'rows' => 2]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status_id', __('tasks.label-task-status')) !!}
        {!! Form::select('status_id', $taskStatuses, $task->status_id, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('assignee_to_id', __('tasks.label-assigned-to')) !!}
        {!! Form::select('assigned_to_id', $users, $task->assigned_to_id, ['class' => 'form-control', 'placeholder' => __('tasks.default-assigned-to')]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('labels', __('tasks.label-labels')) !!}
        {!! Form::select('labels[]', $labels, $taskLabelsIds, ['class' => 'form-control', 'multiple']) !!}
    </div>
    {!! link_to_route('tasks.index', __('tasks.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) !!}
    {!! Form::submit(__('tasks.update-btn'), ['class' => 'btn btn-primary btn-lg']) !!}
    {!! Form::close() !!}
@endsection
