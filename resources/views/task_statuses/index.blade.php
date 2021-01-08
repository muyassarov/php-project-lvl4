@extends('layouts.app')

@section('title', __('task_statuses.list-title'))

@section('content')
    @auth
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('task_statuses.create') }}">{{ __('task_statuses.add-btn') }}</a>
    </div>
    @endauth
    <section>
        <h2>{{ __('task_statuses.list-title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('task_statuses.h-title-id') }}</th>
                <th>{{ __('task_statuses.h-title-name') }}</th>
                <th>{{ __('task_statuses.h-title-created_at') }}</th>
                @auth
                <th>{{ __('task_statuses.h-title-actions') }}</th>
                @endauth
            </tr>
            @isset($taskStatuses)
                @foreach($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>
                        @auth
                        <td>
                            <a class="btn btn-primary" href="{{ route('task_statuses.edit', $taskStatus->id) }}">
                                {{ __('task_statuses.edit-btn') }}
                            </a>
                            {!! Form::open(['route' => ['task_statuses.destroy', $taskStatus->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
                            {!! Form::submit(__('task_statuses.delete-btn'), ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                        @endauth
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
