@section('title', $user->profile->display_name ?? $user->username)

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->profile->display_name ?? $user->username }}
        </h2>
    </x-slot>

    <img src="{{ $user->profile->banner_img_path ?? "https://pbs.twimg.com/profile_banners/1029010076/1520800849/1500x500" }}"
        class="w-full h-96 sm:px-6 lg:px-8" alt="{{ $user->profile->display_name }}'s Banner">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-bl-lg sm:rounded-br-lg">
            <div class="bg-white border-gray-200">
                <img src="{{ $user->profile->profile_img_path ?? "https://i.stack.imgur.com/l60Hf.png" }}"
                    class="h-64 w-64 p-4 rounded-full float-left"
                    alt="{{ $user->profile->display_name }}'s Profile Picture">

                <div class="py-4">
                    <div>
                        <b>{{ $user->profile->display_name ?? $user->username }}</b>
                    </div>
                    <div class="pb-2">
                        <i>{{ '@' . $user->username }}</i>
                    </div>

                    <div class="pb-2">
                        @if ($user->profile->bio)
                            <p>{{ $user->profile->bio }}</p>
                        @endif

                        @if ($user->profile->location)
                            <p>Location: {{ $user->profile->location }}</p>
                        @endif

                        @if ($user->profile->website_url)
                            <p>Website: <a href="{{ $user->profile->website_url }}">{{ $user->profile->website_url }}</a></p>
                        @endif
                    </div>

                    <b>{{ $user->following->count() }}</b> Following
                    <b>{{ $user->followers->count() }}</b> Followers
                </div>
            </div>
        </div>
    </div>

    <ul>
        @foreach ($user->posts as $post)
            <div class="py-1">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="{{ route('users.show', ['user' => $post->user]) }}">
                                <img src="{{ $post->user->profile->profile_img_path ?? "https://i.stack.imgur.com/l60Hf.png" }}"
                                    class="float-left mr-4 rounded-full h-12 w-12"
                                    alt="{{ $post->user->profile->display_name }}'s Profile Picture">
                                <b>{{ $post->user->profile->display_name ?? $post->user->username }}</b>
                                <i>{{ '@' . $post->user->username }}</i>
                            </a>
                            <div>
                                <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->body }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
</x-app-layout>
