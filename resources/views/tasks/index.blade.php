@extends('layouts.app')

@section('title', __('views.task.index.title'))

@section('content')
    @auth
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">{{ __('views.task.index.add') }}</a>
    </div>
    @endauth
    <section>
        @php
        $filter = Request::get('filter');
        $status = $filter['status_id'] ?? null;
        $creator = $filter['created_by_id'] ?? null;
        $assignee = $filter['assigned_to_id'] ?? null;
        @endphp
        {{ Form::open(['route' => 'tasks.index', 'method' => 'get', 'class' => 'form-inline']) }}
        {{ Form::bsInlineSelect('filter[status_id]', 'filterTaskStatus', $taskStatuses, $status, ['placeholder' => __('forms.task.filter.status-placeholder')]) }}
        {{ Form::bsInlineSelect('filter[created_by_id]', 'filterTaskCreator', $users, $creator, ['placeholder' => __('forms.task.filter.creator-placeholder')]) }}
        {{ Form::bsInlineSelect('filter[assigned_to_id]', 'filterTaskAssignee', $users, $assignee, ['placeholder' => __('forms.task.filter.assignee-placeholder')]) }}
        {{ Form::submit(__('forms.task.filter.submit'), ['class' => 'btn btn-outline-primary mb-2']) }}
        {{ Form::close() }}
        <hr/>
        <h2>{{ __('views.task.index.title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('views.task.index.id') }}</th>
                <th>{{ __('views.task.index.status') }}</th>
                <th>{{ __('views.task.index.name') }}</th>
                <th>{{ __('views.task.index.creator') }}</th>
                <th>{{ __('views.task.index.assignee') }}</th>
                <th>{{ __('views.task.index.created-at') }}</th>
                @auth
                <th>{{ __('views.task.index.actions') }}</th>
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
                        <td>{!! $task->assignee->name ?? '&mdash;' !!}</td>
                        <td>{{ $task->created_at }}</td>
                        @auth
                        <td>
                            @can('delete', $task)
                            <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">
                                {{ __('views.task.index.edit') }}
                            </a>
                            {{ Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete', 'class' => 'd-inline']) }}
                            {{ Form::submit(__('forms.task.destroy.delete'), ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                            @endcan
                        </td>
                        @endauth
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
