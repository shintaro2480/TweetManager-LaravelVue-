

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


<h1>Upload New Media</h1>
    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" class="form-control" required>
                <option value="0">Image</option>
                <option value="1">Video</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file">File:</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tag">Tags:</label>
            <input type="text" name="tag[]" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
