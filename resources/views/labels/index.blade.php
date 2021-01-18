@extends('layouts.app')

@section('title', __('views.label.index.title'))

@section('content')
    @auth
        <div class="mb-5">
            <a class="btn btn-primary" href="{{ route('labels.create') }}">{{ __('views.label.index.add-btn') }}</a>
        </div>
    @endauth
    <section>
        <h2>{{ __('views.label.index.title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('views.label.index.h-title-id') }}</th>
                <th>{{ __('views.label.index.h-title-name') }}</th>
                <th>{{ __('views.label.index.h-title-created_at') }}</th>
                @auth
                <th>{{ __('views.label.index.h-title-actions') }}</th>
                @endauth
            </tr>
            @isset($labels)
                @foreach($labels as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->created_at }}</td>
                        @auth
                            <td>
                                <a class="btn btn-primary" href="{{ route('labels.edit', $label) }}">
                                    {{ __('views.label.index.edit-btn') }}
                                </a>
                                {{ Form::open(['route' => ['labels.destroy', $label->id], 'method' => 'delete', 'class' => 'd-inline']) }}
                                {{ Form::submit(__('forms.label.destroy.delete-btn'), ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        @endauth
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
