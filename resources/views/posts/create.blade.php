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
        <p>User ID: <input type="text" name="user_id" value="{{ old('user_id') }}"></p>
        <p>Parent Post ID: <input type="text" name="parent_post_id" value="{{ old('parent_post_id') }}"></p>
        <p>Body: <input type="text" name="body" value="{{ old('body') }}"></p>
        <input type="submit" value="Post">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
