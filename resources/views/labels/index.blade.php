@extends('layouts.app')

@section('title', __('labels.list-title'))

@section('content')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('labels.create') }}">{{ __('labels.add-btn') }}</a>
    </div>
    <section>
        <h2>{{ __('labels.list-title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('labels.h-title-id') }}</th>
                <th>{{ __('labels.h-title-name') }}</th>
                <th>{{ __('labels.h-title-created_at') }}</th>
                <th>{{ __('labels.h-title-actions') }}</th>
            </tr>
            @isset($labels)
                @foreach($labels as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->created_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('labels.edit', $label) }}">
                                {{ __('labels.edit-btn') }}
                            </a>
                            <form action="{{ route('labels.destroy', $label->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    {{ __('labels.delete-btn') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
