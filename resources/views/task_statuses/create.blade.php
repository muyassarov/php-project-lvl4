@extends('layouts.app')

@section('title', 'Create new task status')

@section('content')
    <h2>Add New Task Status</h2>
    <form method="post" action="{{ route('task_statuses.store') }}">
        @csrf
        <div class="form-group">
        <label for="name">Task status</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Status name" required autofocus>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('task_statuses.index') }}">Back</a>
        <button class="btn btn-primary btn-lg" type="submit">Add Status</button>
    </form>
@endsection
