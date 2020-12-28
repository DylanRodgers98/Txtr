@section('title', ($post->user->profile->display_name ?? $user->username) . "'s Post")

<x-app-layout>
    <div class="py-1">
        @foreach ($post->parentPosts() as $parentPost)
            <x-post-component :post="$parentPost"/>
        @endforeach

        <x-post-component :post="$post"/>

        @foreach ($post->replies as $reply)
            <x-post-component :post="$reply"/>
        @endforeach
    </div>
</x-app-layout>
