<?php
$filter   = Request::get('filter');
$status   = $filter['status_id'] ?? '';
$creator  = $filter['created_by_id'] ?? '';
$assignee = $filter['assigned_to_id'] ?? '';
?>
{{ Form::open(['route' => 'tasks.index', 'method' => 'get', 'class' => 'row mb-4']) }}
<div class="col-2">
    {{ Form::label('filterTaskStatus', '', ['class' => 'sr-only']) }}
    {{ Form::select('filter[status_id]', $taskStatuses, $status, ['class' => 'form-control', 'placeholder' => __('tasks.filter-status-placeholder')]) }}
</div>
<div class="col-2">
    {{ Form::label('filterTaskCreator', '', ['class' => 'sr-only']) }}
    {{ Form::select('filter[created_by_id]', $users, $creator, ['class' => 'form-control', 'placeholder' => __('tasks.filter-creator-placeholder')]) }}
</div>
<div class="col-2">
    {{ Form::label('filterTaskAssignee', '', ['class' => 'sr-only']) }}
    {{ Form::select('filter[assigned_to_id]', $users, $assignee, ['class' => 'form-control', 'placeholder' => __('tasks.filter-assignee-placeholder')]) }}
</div>
<div class="col-2">
    {{ Form::submit('Apply', ['class' => 'btn btn-outline-primary']) }}
</div>
{{ Form::close() }}
<hr/>
