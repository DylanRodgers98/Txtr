<x-box>
    @if ($post->user->id == Auth::id())
        <div class="float-right">
            <a href="{{ route('posts.edit', ['post' => $post]) }}">Edit</a>
        </div>
    @endif
    @if ($post->parent_post_id)
        <p class="pb-2">Replying to <a href="{{ route('users.show', ['user' => $post->parentPost->user]) }}">
            {{ "@" . $post->parentPost->user->username }}</a></p>
    @endif
    <a href="{{ route('users.show', ['user' => $post->user]) }}">
        <img src="{{ $post->user->profile->profileImage->url ?? "https://i.stack.imgur.com/l60Hf.png" }}"
            class="float-left mr-4 rounded-full h-16 w-16"
            alt="{{ $post->user->profile->display_name }}'s Profile Picture">
        <b>{{ $post->user->profile->display_name ?? $post->user->username }}</b>
        <i>{{ '@' . $post->user->username }}</i>
    </a>
    <a href="{{ route('posts.show', ['post' => $post, '#post']) }}">
        {{ ' · ' . $post->created_at }}
    </a>
    <div>
        <a href="{{ route('posts.show', ['post' => $post, '#post']) }}">
            {{ $post->body }}
        </a>
    </div>
    <div>
        <a href="{{ route('posts.show', ['post' => $post, '#post']) }}">
            {{ "Reply " . $post->replies->count() }}
        </a>
        {{ " · " }}
        <like-button :number-of-likes="{{ $post->likedBy->count() }}"
            :post-id="{{ $post->id }}" :auth-user-id="{{ Auth::id() }}">
        </like-button>
    </div>
    @if ($post->image)
        <div class="pt-2">
            <a href="{{ $post->image->url }}">
                <img src="{{ $post->image->url }}" class="h-auto w-96 mx-auto"
                    alt="{{ "Image attached to @" . $post->user->username . "'s post" }}">
            </a>
        </div>
    @endif

    {{ $slot }}
</x-box>
