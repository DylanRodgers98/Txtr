@extends('layouts.app')

@section('title', $user->profile->display_name ?? $user->username)

@section('content')
    @if ($user->profile->banner_img_path)
        <img src="{{ $user->profile->banner_img_path }}" alt="{{ $user->profile->display_name }}'s Banner" width="320" height="240">
    @endif
    <h3>{{ $user->profile->display_name ?? $user->username }}</h3>
    <i><b>{{ '@' . $user->username }}</b></i>
    <div>
        @if ($user->profile->profile_img_path)
            <img src="{{ $user->profile->profile_img_path }}" alt="{{ $user->profile->display_name }}'s Profile Picture" width="200" height="200">
        @endif
    </div>
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
