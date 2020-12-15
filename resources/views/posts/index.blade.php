@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <a href="{{ route('posts.create') }}">Create New Post</a>
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('users.show', ['user' => $post->user]) }}">
                    {{ $post->user->profile->display_name }}</a>:
                <a href="{{ route('posts.show', ['post' => $post]) }}">
                    {{ $post->body }}</a>
            </li>
        @endforeach
    </ul>
@endsection
