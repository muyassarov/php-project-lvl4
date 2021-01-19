@extends('layouts.app')

@section('title', __('views.task-status.show.title'))

@section('content')
    <h2>{{ __('views.task-status.show.title') }}</h2>
    <div class="jumbotron">
        <p><strong>{{ __('views.task-status.show.name') }}</strong>: {{ $taskStatus->name }}</p>
        <a class="btn btn-lg btn-secondary" href="{{ route('task_statuses.index') }}">
            {{ __('views.task-status.show.back') }}
        </a>
    </div>
@endsection
