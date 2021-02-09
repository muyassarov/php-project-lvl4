@extends('layouts.app')

@section('title', __('views.task.show.title'))

@section('content')
    <div class="mb-2">
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">{{ __('views.task.show.back') }}</a>
    </div>
    <div class="jumbotron">
        <h1>{{ __('views.task.show.title') }} {{ $task->name }} <a href="{{ route('tasks.edit', $task) }}">⚙</a> </h1>
        <p><strong>{{ __('views.task.show.status') }}</strong>: {{ $task->status->name }}</p>
        <p><strong>{{ __('views.task.show.description') }}</strong>: {{ $task->description }}</p>
        <p><strong>{{ __('views.task.show.creator') }}</strong>: {{ $task->creator->name }}</p>
        <p><strong>{{ __('views.task.show.assignee') }}</strong>: {!! $task->assignee->name ?? '&mdash;' !!}</p>
        <p><strong>{{ __('views.task.show.labels') }}</strong>: {{ $task->labels->implode('name', ', ') }}</p>
    </div>
@endsection
