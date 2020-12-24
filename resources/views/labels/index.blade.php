@extends('layouts.app')

@section('title', __('labels.list-title'))

@section('content')
    @auth
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('labels.create') }}">{{ __('labels.add-btn') }}</a>
    </div>
    @endauth
    <section>
        <h2>{{ __('labels.list-title') }}</h2>
        <table class="table">
            <tr>
                <th>{{ __('labels.h-title-id') }}</th>
                <th>{{ __('labels.h-title-name') }}</th>
                <th>{{ __('labels.h-title-created_at') }}</th>
                @auth
                <th>{{ __('labels.h-title-actions') }}</th>
                @endauth
            </tr>
            @isset($labels)
                @foreach($labels as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->created_at }}</td>
                        @auth
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
                        @endauth
                    </tr>
                @endforeach
            @endisset
        </table>
    </section>
@endsection
