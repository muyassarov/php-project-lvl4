@extends('layouts.app')

@section('title', __('task_statuses.update-title'))

@section('content')
    <h2>{{ __('task_statuses.update-title') }}</h2>
    {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'put']) }}
    <div class="form-group">
        {{ Form::label('name', __('task_statuses.label-name')) }}
        {{ Form::text('name', $taskStatus->name, ['class' => 'form-control', 'placeholder' => __('task_statuses.task-status-placeholder'), 'required', 'autofocus']) }}
    </div>
    {{ link_to_route('task_statuses.index', __('task_statuses.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('task_statuses.update-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
