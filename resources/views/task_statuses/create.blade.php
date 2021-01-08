@extends('layouts.app')

@section('title', __('task_statuses.create-title'))

@section('content')
    <h2>{{ __('task_statuses.create-title') }}</h2>
    {!! Form::open(['route' => 'task_statuses.store']) !!}
    <div class="form-group">
        {!! Form::label('name', __('task_statuses.label-name')) !!}
        {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('task_statuses.task-status-placeholder'), 'required', 'autofocus']) !!}
    </div>
    {!! link_to_route('task_statuses.index', __('task_statuses.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) !!}
    {!! Form::submit(__('task_statuses.add-btn'), ['class' => 'btn btn-primary btn-lg']) !!}
    {!! Form::close() !!}
@endsection
