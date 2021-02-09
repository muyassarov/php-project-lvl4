@extends('layouts.app')

@section('title', __('views.task.create.title'))

@section('content')
    <h2>{{ __('views.task.create.title') }}</h2>
    {{ Form::open(['route' => 'tasks.store']) }}
    {{ Form::bsText('name', '', __('forms.task.create.name-label'), ['placeholder' => __('forms.task.create.name-placeholder'), 'required', 'autofocus']) }}
    {{ Form::bsTextarea('description', '', __('forms.task.create.description-label'), ['placeholder' => __('forms.task.create.description-placeholder'), 'rows' => 2]) }}
    {{ Form::bsSelect('status_id', $taskStatuses, 'New', __('forms.task.create.status-label'), ['required']) }}
    {{ Form::bsSelect('assigned_to_id', $users, null, __('forms.task.create.assigned-to-label'), ['placeholder' => __('forms.task.create.assigned-to-placeholder')]) }}
    {{ Form::bsSelect('labels[]', $labels, null, __('forms.task.create.labels-label'), ['multiple']) }}
    {{ link_to_route('tasks.index', __('forms.task.create.back'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task.create.submit'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
