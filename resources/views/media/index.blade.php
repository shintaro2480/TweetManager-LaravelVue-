@extends('layouts.app')

@section('content')
<div class="container">

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('media.index')" :active="request()->routeIs('media.index')">
        {{ __('Lists') }}
    </x-nav-link>
    <x-nav-link :href="route('media.create')" :active="request()->routeIs('media.create')">
        {{ __('Upload') }}
    </x-nav-link>
</div>

    <h1>Media List</h1>
    <a href="{{ route('media.create') }}" class="btn btn-primary">Upload New Media</a>
    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>File</th>
            <th>Tags</th>
            <th>Actions</th>
        </tr>
        @foreach ($media as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type == 0 ? 'Image' : 'Video' }}</td>
            <td><a href="{{ asset('storage/' . $item->file) }}" target="_blank">{{ $item->file }}</a></td>
            <td></td>
            <td>
                <a href="{{ route('media.show', $item->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('media.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('media.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
