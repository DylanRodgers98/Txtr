<x-box>
    @if ($post->parent_post_id)
        <p class="pb-2">Replying to <a href="{{ route('users.show', ['user' => $post->parentPost->user]) }}">
            {{ "@" . $post->parentPost->user->username }}</a></p>
    @endif
    <a href="{{ route('users.show', ['user' => $post->user]) }}">
        <img src="{{ $post->user->profile->profile_img_path ?? "https://i.stack.imgur.com/l60Hf.png" }}"
            class="float-left mr-4 rounded-full h-16 w-16"
            alt="{{ $post->user->profile->display_name }}'s Profile Picture">
        <b>{{ $post->user->profile->display_name ?? $post->user->username }}</b>
        <i>{{ '@' . $post->user->username }}</i>
    </a>
    <a href="{{ route('posts.show', ['post' => $post]) }}">
        {{ ' · ' . $post->created_at }}
    </a>
    <div>
        <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->body }}</a>
    </div>
    <div>
        <a href="">{{ "Reply " . $post->replies->count() }}</a>
            {{ " · " }}
        <a href="">{{ "Like " . $post->likedBy->count() }}</a>
    </div>
</x-box>
