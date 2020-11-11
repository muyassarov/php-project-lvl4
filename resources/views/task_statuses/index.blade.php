@extends('layouts.app')

@section('title', 'List of task statuses')

@section('content')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('task_statuses.create') }}">Add Task Status</a>
    </div>
    <section>
        <h2>List of task statuses</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            @isset($taskStatuses)
                @foreach($taskStatuses as $taskStatus)
                    <tr>
                        <td>{{ $taskStatus->id }}</td>
                        <td>{{ $taskStatus->name }}</td>
                        <td>{{ $taskStatus->created_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('task_statuses.edit', $taskStatus->id) }}">Edit</a>
                            <form action="{{ route('task_statuses.destroy', $taskStatus->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
