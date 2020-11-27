@extends('layouts.app')

@section('title', __('task.list-title'))

@section('content')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('task.create') }}">{{ __('task.add-btn') }}</a>
    </div>
    <section>
        <h2>{{ __('task.list-title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('task.h-title-id') }}</th>
                <th>{{ __('task.h-title-name') }}</th>
                <th>{{ __('task.h-title-created_at') }}</th>
                <th>{{ __('task.h-title-actions') }}</th>
            </tr>
            @isset($tasks)
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('task.edit', $task->id) }}">
                                {{ __('task.edit-btn') }}
                            </a>
                            <form action="{{ route('task.destroy', $task->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    {{ __('task.delete-btn') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
