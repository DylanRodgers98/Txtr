@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
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
