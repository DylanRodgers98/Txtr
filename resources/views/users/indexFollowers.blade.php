@section('title', "People following " . $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    @foreach ($user->followers as $follower)
        <p>{{ $follower->username }}</p>
    @endforeach
</x-app-layout>
