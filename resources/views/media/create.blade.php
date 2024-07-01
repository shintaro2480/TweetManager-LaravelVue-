

@extends('layouts.app')

@section('content')



<div class="container" style="margin-left:60px;">

<!--ナビゲーション-->
<x-media-nav></x-media-nav>



<h1>Upload New Media</h1>

<upload-media></upload-media>


<form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label for="tags">Select a Tag:</label>
            @foreach ($tags as $tag)
                <div class="inline-block">
                    <input type="radio" id="tag_{{ $tag->id }}" name="tag_id" value="{{ $tag->id }}" required>
                    <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            @endforeach

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="0">Image</option>
                <option value="1">Video</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file">File:</label>
            <input type="file" id="file" name="file" class="form-control" required>
        </div>

        <x-primary-button class="mt-4">
                        送信する
                    </x-primiary-button>
    </form>
</div>
@endsection
