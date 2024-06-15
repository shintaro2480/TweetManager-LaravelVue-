<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('media.index')" :active="request()->routeIs('media.index')">
        {{ __('Lists') }}
    </x-nav-link>
    <x-nav-link :href="route('media.create')" :active="request()->routeIs('media.create')">
        {{ __('Upload') }}
    </x-nav-link>
    <x-nav-link :href="route('tag.index')" :active="request()->routeIs('tag.index')">
        {{ __('Tag') }}
    </x-nav-link>
</div>

</div>