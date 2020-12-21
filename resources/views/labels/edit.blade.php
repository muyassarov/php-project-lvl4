@extends('layouts.app')

@section('title', __('labels.update-title'))

@section('content')
    <h2>{{ __('labels.update-title') }}</h2>
    <form method="post" action="{{ route('labels.update', $label) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">{{ __('labels.label-name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('labels.label-name-placeholder') }}"
                   value="{{ $label->name }}" required autofocus>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('labels.index') }}">{{ __('labels.back-btn') }}</a>
        <button class="btn btn-primary btn-lg" type="submit">{{ __('labels.update-btn') }}</button>
    </form>
@endsection
