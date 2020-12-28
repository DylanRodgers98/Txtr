@section('title', $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    <img src="{{ $user->profile->banner_img_path ?? "https://pbs.twimg.com/profile_banners/1029010076/1520800849/1500x500" }}"
        class="w-full h-96 sm:px-6 lg:px-8" alt="{{ $user->profile->display_name }}'s Banner">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-1">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-bl-lg sm:rounded-br-lg">
            <div class="bg-white border-gray-200">
                <img src="{{ $user->profile->profile_img_path ?? "https://i.stack.imgur.com/l60Hf.png" }}"
                    class="h-64 w-64 p-4 rounded-full float-left"
                    alt="{{ $user->profile->display_name }}'s Profile Picture">

                <div class="p-4">
                    <button class="float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        @if ($isAuthUser)
                            Edit Profile
                        @elseif ($isAuthUserFollowing)
                            Unfollow
                        @else
                            Follow
                        @endif
                    </button>

                    <div>
                        <b>{{ $user->profile->display_name ?? $user->username }}</b>
                    </div>
                    <div class="pb-2">
                        <i>{{ '@' . $user->username }}</i>
                    </div>

                    <div class="pb-2">
                        @if ($user->profile->bio)
                            <p>{{ $user->profile->bio }}</p>
                        @endif

                        @if ($user->profile->location)
                            <p>Location: {{ $user->profile->location }}</p>
                        @endif

                        @if ($user->profile->website_url)
                            <p>Website: <a href="{{ $user->profile->website_url }}">{{ $user->profile->website_url }}</a></p>
                        @endif
                    </div>

                    <a href="{{ route('users.indexFollowing', ['user' => $user]) }}">
                        <b>{{ $user->following->count() }}</b> Following
                    </a>
                    <a href="{{ route('users.indexFollowers', ['user' => $user]) }}">
                        <b>{{ $user->followers->count() }}</b> Followers
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-1">
        @foreach ($user->posts as $post)
            <x-post-component :post="$post"/>
        @endforeach
    </div>
</x-app-layout>
