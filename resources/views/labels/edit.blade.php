@extends('layouts.app')

@section('title', __('views.label.edit.title'))

@section('content')
    <h2>{{ __('views.label.edit.title') }}</h2>
    {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'put']) }}
    <div class="form-group">
        {{ Form::label('name', __('forms.label.edit.name-label')) }}
        {{ Form::text('name', $label->name, ['class' => 'form-control', 'placeholder' => __('forms.label.edit.name-placeholder'), 'required', 'autofocus']) }}
    </div>
    {{ link_to_route('labels.index', __('forms.label.edit.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) }}
    {{ Form::submit(__('forms.label.edit.submit-btn'), ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}
@endsection
