@extends('layouts.app')

@section('title', $post->user->profile->display_name . '\'s post')

@section('content')
    <ul>
        <li>User: {{ $post->user->profile->display_name }}</li>
        @if ($post->parent_post_id)
            <li>Reply to: <a href="{{ route('posts.show', ['id' => $post->parent_post_id]) }}">{{ $post->parentPost->body }}</a></li>
        @endif
        <li>Body: {{ $post->body }}</li>
        @if ($post->replies->count() > 0)
            <li>Replies:
                <ul>
                    @foreach ($post->replies as $reply)
                        <li>
                            <a href="{{ route('posts.show', ['id' => $reply->id]) }}">
                                {{ $reply->user->profile->display_name }}: {{ $reply->body }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
@endsection
