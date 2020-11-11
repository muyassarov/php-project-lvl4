@extends('layouts.app')

@section('title', "Edit task status")

@section('content')
    <h2>Update Task Status</h2>
    <form method="post" action="{{ route('task_statuses.update', $taskStatus->id) }}">
        @method('put')
        @csrf
        <div class="form-group">
        <label for="name">Task status</label>
        <input type="text" name="name" id="name" value="{{ $taskStatus->name }}" class="form-control"
               placeholder="Status name" required autofocus>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('task_statuses.index') }}">Back</a>
        <button class="btn btn-primary btn-lg" type="submit">Update Status</button>
    </form>
@endsection
