@extends('layouts.app')

@section('title', __('views.label.create.title'))

@section('content')
    <h2>{{ __('views.label.create.title') }}</h2>
    {{ Form::open(['route' => 'labels.store']) }}
    {{ Form::bsText('name', '', __('forms.label.create.name-label'), ['placeholder' => __('forms.label.create.name-placeholder'), 'required', 'autofocus']) }}
    {{ link_to_route('labels.index', __('forms.label.create.back'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.label.create.submit'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
