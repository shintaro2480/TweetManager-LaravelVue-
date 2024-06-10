

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
        
        <ul>
            @foreach($tags as $tag)
                <li>
                    <label>
                        <input type="radio" name="selected_tag" id="{{ $tag->name }}" value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </li>
            @endforeach
        </ul>

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
