@extends('layouts.app')

@section('title', __('tasks.show-title'))

@section('content')
    <div class="mb-2">
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Back</a>
    </div>
    <div class="jumbotron">
        <h1>{{ __('tasks.show-title') }} {{ $task->name }} <a href="{{ route('tasks.edit', $task) }}">⚙</a> </h1>
        <p><strong>Status</strong>: {{ $task->status->name }}</p>
        <p><strong>Description</strong>: {{ $task->description }}</p>
        <p><strong>Creator</strong>: {{ $task->creator->name }}</p>
        <p><strong>Assignee</strong>: {!! $task->assignee->name ?? '&mdash;' !!}</p>
    </div>
@endsection
