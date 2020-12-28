<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Posts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('posts.create') }}">Create New Post</a>
                </div>
            </div>
        </div>
    </div>

    @foreach ($posts as $post)
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
</x-app-layout>
