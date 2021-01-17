@extends('layouts.app')

@section('title', __('views.label.create.title'))

@section('content')
    <h2>{{ __('views.label.create.title') }}</h2>
    {{ Form::open(['route' => 'labels.store']) }}
    <div class="form-group">
        {{ Form::label('name', __('forms.label.create.name-label')) }}
        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => __('forms.label.create.name-placeholder'), 'required', 'autofocus']) }}
    </div>
    {{ link_to_route('labels.index', __('forms.label.create.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.label.create.add-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
