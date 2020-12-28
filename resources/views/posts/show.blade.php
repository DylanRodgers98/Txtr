@section('title', ($post->user->profile->display_name ?? $user->username) . "'s Post")

<x-app-layout>
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
                        {{ ' · ' . $post->created_at }}
                    </a>
                    <div>
                        <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->body }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <ul>
        <li>User: <a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->profile->display_name ?? $user->username }}</a></li>
        @if ($post->parent_post_id)
            <li>Reply to:
                <ul>
                    <li>
                        <a href="{{ route('users.show', ['user' => $post->user_id]) }}">
                            {{ $post->user->profile->display_name ?? $user->username }}</a>:
                        <a href="{{ route('posts.show', ['post' => $post->parent_post_id]) }}">
                            {{ $post->parentPost->body }}</a>
                    </li>
                </ul>
            </li>
        @endif
        <li>Body: {{ $post->body }}</li>
        @if ($post->replies->count() > 0)
            <li>Replies:
                <ul>
                    @foreach ($post->replies as $reply)
                        <li>
                            <a href="{{ route('users.show', ['user' => $reply->user_id]) }}">
                                {{ $reply->user->profile->display_name ?? $user->username }}</a>:
                            <a href="{{ route('posts.show', ['post' => $reply->id]) }}">
                                {{ $reply->body }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>

    <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Post</button>
    </form>

    <p><a href="{{ route('posts.index') }}">Back</a></p> --}}
</x-app-layout>
