@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
    @if ($errors->any())
        <div>
            Errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <p>User:
            <select name="user_id">
                <option value="" disabled selected hidden>Choose a user...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        @if ($user->id == old('user_id'))
                            selected="selected"
                        @endif
                    >{{ $user->profile->display_name }}</option>
                @endforeach
            </select>
        </p>
        <p>Reply to:
            <select name="parent_post_id">
                <option value="" disabled selected hidden>
                @foreach ($posts as $post)
                    <option value="{{ $post->id }}"
                        @if ($user->id == old('parent_post_id'))
                            selected="selected"
                        @endif
                    >{{ $post->user->profile->display_name }}: {{ $post->body }}</option>
                @endforeach
            </select>
        </p>
        <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
        <input type="submit" value="Post">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
