@extends('layouts.app')

@section('title', __('views.task-status.create.title'))

@section('content')
    <h2>{{ __('views.task-status.create.title') }}</h2>
    {{ Form::open(['route' => 'task_statuses.store']) }}
    {{ Form::bsText('name', '', __('forms.task-status.create.name-label'), ['placeholder' => __('forms.task-status.create.name-placeholder'), 'required', 'autofocus']) }}
    {{ link_to_route('task_statuses.index', __('forms.task-status.create.back'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.task-status.create.submit'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
