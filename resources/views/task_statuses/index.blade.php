@extends('layouts.app')

@section('title', __('task_statuses.list-title'))

@section('content')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('task_statuses.create') }}">{{ __('task_statuses.add-btn') }}</a>
    </div>
    <section>
        <h2>{{ __('task_statuses.list-title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('task_statuses.h-title-id') }}</th>
                <th>{{ __('task_statuses.h-title-name') }}</th>
                <th>{{ __('task_statuses.h-title-created_at') }}</th>
                <th>{{ __('task_statuses.h-title-actions') }}</th>
            </tr>
            @isset($taskStatuses)
                @foreach($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('task_statuses.edit', $taskStatus->id) }}">
                                {{ __('task_statuses.edit-btn') }}
                            </a>
                            <form action="{{ route('task_statuses.destroy', $taskStatus->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    {{ __('task_statuses.delete-btn') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
