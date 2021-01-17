@extends('layouts.app')

@section('title', __('views.task-status.create.title'))

@section('content')
    <h2>{{ __('views.task-status.create.title') }}</h2>
    {{ Form::open(['route' => 'task_statuses.store']) }}
    <div class="form-group">
        {{ Form::label('name', __('forms.task-status.create.name-label')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('forms.task-status.create.name-placeholder'), 'required', 'autofocus']) }}
    </div>
    {{ link_to_route('task_statuses.index', __('forms.task-status.create.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task-status.create.add-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
