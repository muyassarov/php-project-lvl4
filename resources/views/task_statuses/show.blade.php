@extends('layouts.app')

@section('title', "Show task status")

@section('content')
    <h2>Task Status</h2>
    <form>
        <div class="form-group">
            <label for="name">Task status</label>
            <input type="text" name="name" id="name" value="{{ $taskStatus->name }}" class="form-control"
                   placeholder="Status name" required disabled>
        </div>
        <a class="btn btn-lg btn-secondary" href="{{ route('task_statuses.index') }}">Back</a>
    </form>
@endsection
