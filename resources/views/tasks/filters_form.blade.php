<?php
$filter = Request::get('filter');
$status = $filter['status_id'] ?? '';
$creator = $filter['created_by_id'] ?? '';
$assignee = $filter['assigned_to_id'] ?? '';
?>
<form action="{{ route('tasks.index') }}" method="get" class="row mb-4">
    <div class="col-2">
        <label for="filterTaskStatus" class="sr-only"></label>
        <select class="form-control" name="filter[status_id]" id="filterTaskStatus">
            <option value="">Status</option>
            @foreach($taskStatuses as $taskStatus)
            <option {{ $status == $taskStatus->id ? 'selected' : '' }}
                    value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <label for="filterTaskCreator" class="sr-only"></label>
        <select class="form-control" name="filter[created_by_id]" id="filterTaskCreator">
            <option value="">Creator</option>
            @foreach($users as $user)
            <option {{ $creator == $user->id ? 'selected' : '' }}
                    value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <label for="filterTaskAssignee" class="sr-only"></label>
        <select class="form-control" name="filters[assigned_to_id]" id="filterTaskAssignee">
            <option value="">Assignee</option>
            @foreach($users as $user)
            <option {{ $assignee == $user->id ? 'selected' : '' }}
                    value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <button type="submit" class="btn btn-outline-primary">Apply</button>
    </div>
</form>
<hr/>
