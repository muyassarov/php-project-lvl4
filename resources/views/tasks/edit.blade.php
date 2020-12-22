@extends('layouts.app')

@section('title', __('tasks.update-title'))

@section('content')
    <h2>{{ __('tasks.update-title') }}</h2>
    <form method="post" action="{{ route('tasks.update', $task) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">{{ __('tasks.label-name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('tasks.task-name-placeholder') }}"
                   value="{{ $task->name }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="description">{{ __('tasks.label-description') }}</label>
            <textarea id="description" name="description" class="form-control"
                      placeholder="{{ __('tasks.task-description-placeholder') }}">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="status_id">{{ __('tasks.label-task-status') }}</label>
            <select name="status_id" id="status_id" class="form-control" required>
                @foreach($taskStatuses as $taskStatus)
                <option {{$taskStatus->id == $task->status_id ? 'selected' : ''}}
                        value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="assigned_to_id">{{ __('tasks.label-assigned-to') }}</label>
            <select name="assigned_to_id" id="assigned_to_id" class="form-control">
                <option value="">{{ __('tasks.default-assigned-to') }}</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $task->assigned_to_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="labels">{{ __('tasks.label-labels') }}</label>
            <select name="labels[]" id="labels" class="form-control" multiple>
                @foreach($labels as $label)
                    <option value="{{ $label->id }}">{{ $label->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('tasks.index') }}">{{ __('tasks.back-btn') }}</a>
        <button class="btn btn-primary btn-lg" type="submit">{{ __('tasks.update-btn') }}</button>
    </form>
@endsection
