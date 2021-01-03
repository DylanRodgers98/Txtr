@section('title', "People followed by " . $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    <div class="py-1">
        @foreach ($user->following as $followedUser)
            <x-user-summary :user="$followedUser"/>
        @endforeach
    </div>
</x-app-layout>
