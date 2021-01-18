@extends('layouts.app')

@section('title', __('views.task-status.index.title'))

@section('content')
    @auth
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('task_statuses.create') }}">{{ __('views.task-status.index.add-btn') }}</a>
    </div>
    @endauth
    <section>
        <h2>{{ __('views.task-status.index.title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('views.task-status.index.h-title-id') }}</th>
                <th>{{ __('views.task-status.index.h-title-name') }}</th>
                <th>{{ __('views.task-status.index.h-title-created_at') }}</th>
                @auth
                <th>{{ __('views.task-status.index.h-title-actions') }}</th>
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
                                {{ __('views.task-status.index.edit-btn') }}
                            </a>
                            {{ Form::open(['route' => ['task_statuses.destroy', $taskStatus->id], 'method' => 'delete', 'class' => 'd-inline']) }}
                            {{ Form::submit(__('forms.task-status.destroy.delete-btn'), ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                        @endauth
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
