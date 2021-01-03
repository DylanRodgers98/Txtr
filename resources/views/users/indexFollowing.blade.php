@section('title', "People followed by " . $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    <x-page-title>
        <div class="mx-6 my-4">
            <b>People followed by <a href="{{ route('users.show', ['user' => $user]) }}">
                {{ $user->profile->display_name . " (@" . $user->username . ")" }}</a></b>
        </div>
    </x-page-title>

    <div class="py-1">
        @foreach ($following as $followedUser)
            <x-user-summary :user="$followedUser"/>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $following->links() }}
        </div>
    </div>
</x-app-layout>
