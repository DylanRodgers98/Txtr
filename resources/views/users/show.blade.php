@extends('layouts.app')

@section('title', $user->profile->display_name)

@section('content')
    <h3>{{ $user->profile->display_name }}</h3>
    @if ($user->profile->bio)
        <p>Bio: {{ $user->profile->bio }}</p>
    @endif
    @if ($user->profile->location)
        <p>Location: {{ $user->profile->location }}</p>
    @endif
    @if ($user->profile->website_url)
        <p>Website: <a href="{{ $user->profile->website_url }}">{{ $user->profile->website_url }}</a></p>
    @endif
    <p>Followers: {{ $user->followers->count() }} | Following: {{ $user->following->count() }}</p>
    @if ($user->posts->count() > 0)
        <p>Posts:
            <ul>
                @foreach ($user->posts as $post)
                    <li>
                        <a href="{{ route('posts.show', ['post' => $post]) }}">
                            {{ $post->body }}
                        </a>
                    </li>
                 @endforeach
            </ul>
        </p>
    @endif
@endsection
