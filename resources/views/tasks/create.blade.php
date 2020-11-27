@extends('layouts.app')

@section('title', __('task.create-title'))

@section('content')
    <h2>{{ __('task.create-title') }}</h2>
    <form method="post" action="{{ route('task.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('task.label-name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('task.task-status-placeholder') }}" required autofocus>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('task.index') }}">{{ __('task.back-btn') }}</a>
        <button class="btn btn-primary btn-lg" type="submit">{{ __('task.add-btn') }}</button>
    </form>
@endsection
