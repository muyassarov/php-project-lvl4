@extends('layouts.app')

@section('title', __('views.task.create.title'))

@section('content')
    <h2>{{ __('views.task.create.title') }}</h2>
    {{ Form::open(['route' => 'tasks.store']) }}
    <div class="form-group">
        {{ Form::label('name', __('forms.task.create.name-label')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('forms.task.create.name-placeholder'), 'required', 'autofocus']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', __('forms.task.create.description-label')) }}
        {{ Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => __('forms.task.create.description-placeholder'), 'rows' => 2]) }}
    </div>
    <div class="form-group">
        {{ Form::label('status_id', __('forms.task.create.status-label')) }}
        {{ Form::select('status_id', $taskStatuses, 'New', ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group">
        {{ Form::label('assignee_to_id', __('forms.task.create.assigned-to-label')) }}
        {{ Form::select('assigned_to_id', $users, null, ['class' => 'form-control', 'placeholder' => __('forms.task.create.assigned-to-placeholder')]) }}
    </div>
    <div class="form-group">
        {{ Form::label('labels', __('forms.task.create.labels-label')) }}
        {{ Form::select('labels[]', $labels, null, ['class' => 'form-control', 'multiple']) }}
    </div>
    {{ link_to_route('tasks.index', __('forms.task.create.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task.create.submit-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
