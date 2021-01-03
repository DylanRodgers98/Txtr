@section('title', "People following " . $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    <x-page-title>
        <div class="mx-6 my-4">
            <b>People following <a href="{{ route('users.show', ['user' => $user]) }}">
                {{ $user->profile->display_name . " (@" . $user->username . ")" }}</a></b>
        </div>
    </x-page-title>

    <div class="py-1">
        @foreach ($followers as $follower)
            <x-user-summary :user="$follower"/>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $followers->links() }}
        </div>
    </div>
</x-app-layout>
