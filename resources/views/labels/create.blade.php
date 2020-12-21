@extends('layouts.app')

@section('title', __('labels.create-title'))

@section('content')
    <h2>{{ __('labels.create-title') }}</h2>
    <form method="post" action="{{ route('labels.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('labels.label-name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('labels.label-name-placeholder') }}"
                   required autofocus>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('labels.index') }}">{{ __('labels.back-btn') }}</a>
        <button class="btn btn-primary btn-lg" type="submit">{{ __('labels.add-btn') }}</button>
    </form>
@endsection
