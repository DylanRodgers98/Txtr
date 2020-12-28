@section('title', "People followed by " . $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    @foreach ($user->following as $followedUser)
        <p>{{ $followedUser->username }}</p>
    @endforeach
</x-app-layout>
