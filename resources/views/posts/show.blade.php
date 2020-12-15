@extends('layouts.app')

@section('title', $post->user->profile->display_name . '\'s Post')

@section('content')
    <ul>
        <li>User: <a href="{{ route('users.show', ['user' => $post->user]) }}">{{ $post->user->profile->display_name }}</a></li>
        @if ($post->parent_post_id)
            <li>Reply to:
                <ul>
                    <li>
                        <a href="{{ route('users.show', ['user' => $post->user_id]) }}">
                            {{ $post->user->profile->display_name }}</a>:
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
                                {{ $reply->user->profile->display_name }}</a>:
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

    <p><a href="{{ route('posts.index') }}">Back</a></p>
@endsection
