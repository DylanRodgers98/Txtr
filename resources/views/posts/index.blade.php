@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <a href="{{ route('posts.create') }}">Create New Post</a>
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                    {{ $post->user->profile->display_name }}: {{ $post->body }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
