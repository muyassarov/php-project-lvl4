@extends('layouts.app')

@section('title', __('labels.update-title'))

@section('content')
    <h2>{{ __('labels.update-title') }}</h2>
    {!! Form::model($label, ['route' => ['labels.update', $label], 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::label('name', __('labels.label-name')) !!}
        {!! Form::text('name', $label->name, ['class' => 'form-control', 'placeholder' => __('labels.label-name-placeholder'), 'required', 'autofocus']) !!}
    </div>
    {!! link_to_route('labels.index', __('labels.back-btn'), [], ['class' => 'btn btn-lg btn-secondary']) !!}
    {!! Form::submit(__('labels.update-btn'), ['class' => 'btn btn-primary btn-lg']) !!}
    {!! Form::close() !!}
@endsection
