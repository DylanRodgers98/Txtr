@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h3>All posts:</h3>
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->body }}</li>
        @endforeach
    </ul>
@endsection
