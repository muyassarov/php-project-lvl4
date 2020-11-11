@extends('layouts.app')

@section('title', __('task_statuses.create-title'))

@section('content')
    <h2>{{ __('task_statuses.create-title') }}</h2>
    <form method="post" action="{{ route('task_statuses.store') }}">
        @csrf
        <div class="form-group">
        <label for="name">{{ __('task_statuses.label-name') }}</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('task_statuses.task-status-placeholder') }}" required autofocus>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('task_statuses.index') }}">{{ __('task_statuses.back-btn') }}</a>
        <button class="btn btn-primary btn-lg" type="submit">{{ __('task_statuses.add-btn') }}</button>
    </form>
@endsection
