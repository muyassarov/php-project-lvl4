@extends('layouts.app')

@section('title', __('task_statuses.show-title'))

@section('content')
    <h2>{{ __('task_statuses.show-title') }}</h2>
    <form>
        <div class="form-group">
            <label for="name">{{ __('task_statuses.label-name') }}</label>
            <input type="text" name="name" id="name" value="{{ $taskStatus->name }}" class="form-control"
                   required disabled>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('task_statuses.index') }}">
            {{ __('task_statuses.back-btn') }}
        </a>
    </form>
@endsection
