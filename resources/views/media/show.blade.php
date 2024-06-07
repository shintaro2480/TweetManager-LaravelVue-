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

    <h1>{{ $media->name }}</h1>
    <p>Type: {{ $media->type == 0 ? 'Image' : 'Video' }}</p>
    {{-- <p>Tags: {{ implode(', ', json_decode($media->tag)) }}</p> --}}
    <p>
        <a href="{{ asset('storage/' . $media->file) }}" target="_blank">
            {{ $media->file }}
        </a>
    </p>
    <a href="{{ route('media.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
