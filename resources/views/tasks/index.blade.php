@extends('layouts.app')

@section('title', __('tasks.list-title'))

@section('content')
    @auth
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">{{ __('tasks.add-btn') }}</a>
    </div>
    @endauth
    <section>
        @include('tasks.filters_form')
        <h2>{{ __('tasks.list-title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('tasks.h-title-id') }}</th>
                <th>{{ __('tasks.h-title-status') }}</th>
                <th>{{ __('tasks.h-title-name') }}</th>
                <th>{{ __('tasks.h-title-creator') }}</th>
                <th>{{ __('tasks.h-title-assignee') }}</th>
                <th>{{ __('tasks.h-title-created_at') }}</th>
                @auth
                <th>{{ __('tasks.h-title-actions') }}</th>
                @endauth
            </tr>
            @isset($tasks)
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->status->name }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a>
                        </td>
                        <td>{{ $task->creator->name }}</td>
                        <td>{{ $task->assignee->name }}</td>
                        <td>{{ $task->created_at }}</td>
                        @auth
                        <td>
                            <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">
                                {{ __('tasks.edit-btn') }}
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    {{ __('tasks.delete-btn') }}
                                </button>
                            </form>
                        </td>
                        @endauth
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
