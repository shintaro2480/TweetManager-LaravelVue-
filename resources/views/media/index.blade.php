@extends('layouts.app')

@section('content')
<div class="container" style="margin-left:60px;">

<!--ナビゲーション-->
<x-media-nav></x-media-nav>

    <h1>Media List</h1>
    <test-component></test-component>



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
            <td><img src="{{ asset('storage/thumbnail/' . $item->file) }}"></td>
            <td>{{ $item->tag->name }}</td>
            <td><img src="http://127.0.0.1:8000/public/storage/uploads/test.png"></td>
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
