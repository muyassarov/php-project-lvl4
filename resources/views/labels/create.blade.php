@extends('layouts.app')

@section('title', __('labels.create-title'))

@section('content')
    <h2>{{ __('labels.create-title') }}</h2>
    {{ Form::open(['route' => 'labels.store']) }}
    <div class="form-group">
        {{ Form::label('name', __('labels.label-name')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('labels.label-name-placeholder'), 'required', 'autofocus']) }}
    </div>
    {{ link_to_route('labels.index', __('labels.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('labels.add-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
