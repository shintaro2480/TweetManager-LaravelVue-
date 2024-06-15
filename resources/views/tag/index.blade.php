@extends('layouts.app')
@section('content')

<div class="container" style="margin-left:60px;">

<!--ナビゲーション-->
<x-media-nav></x-media-nav>

    <h1>Tag Manager</h1>

    <div class="tag-list">

    <form action="{{ route('tag.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Create new tag:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <x-primary-button class="mt-4">
                        Create
        </x-primiary-button>
    </form>

    @foreach ($tags as $tag)
            <div class="border-2 rounded-md inline-block">{{ $tag->name }}
            <form action="{{ route('tag.destroy', $tag->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button" onclick="return confirm('Are you sure?')">×</button>
            </form>
        </div>
    @endforeach
</div>
</div>
@endsection
