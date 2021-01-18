@extends('layouts.app')

@section('title', __('views.task-status.edit.title'))

@section('content')
    <h2>{{ __('views.task-status.edit.title') }}</h2>
    {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'put']) }}
    {{ Form::bsText('name', $taskStatus->name, __('forms.task-status.edit.name-label'), ['placeholder' => __('forms.task-status.edit.name-placeholder'), 'required', 'autofocus']) }}
    {{ link_to_route('task_statuses.index', __('forms.task-status.edit.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task-status.edit.submit-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
