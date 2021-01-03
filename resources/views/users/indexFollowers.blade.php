@section('title', "People following " . $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    <div class="py-1">
        @foreach ($user->followers as $follower)
            <x-user-summary :user="$follower"/>
        @endforeach
    </div>
</x-app-layout>
