@section('title', $user->profile->display_name . " (@" . $user->username . ")")

<x-app-layout>
    <div class="pb-1">
        <x-page-title>
            <img src="{{ $user->profile->profileImage->url ?? env('DEFAULT_PROFILE_IMAGE_URL') }}"
                class="h-64 w-64 p-4 rounded-full float-left"
                alt="{{ $user->profile->display_name }}'s Profile Picture">

            <div class="p-4">
                @if (Auth::id() === $user->id)
                    <a href="{{ route('users.profile.edit', ['user' => $user]) }}">
                        <button class="float-right bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full">
                            Edit Profile
                        </button>
                    </a>
                @else
                    <div class="float-right">
                        <follow-button :profile-user-id="{{ $user->id }}"
                            :auth-user-id="{{ Auth::id() }}"
                            follower-count-element-id="followerCount">
                        </follow-button>
                    </div>
                @endif

                <div>
                    <b>{{ $user->profile->display_name ?? $user->username }}</b>
                </div>
                <div class="pb-2">
                    <i>{{ '@' . $user->username }}</i>
                </div>

                <div class="pb-2">
                    <p>{{ $user->profile->bio }}</p>

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
                    <b id="followerCount">{{ $user->followers->count() }}</b> Followers
                </a>
            </div>
        </x-page-title>
    </div>

    <div class="pb-1">
        @foreach ($posts as $post)
            <x-post :post="$post"/>
        @endforeach
    </div>

    <div class="pb-2 sm:px-6 lg:px-8">
        {{ $posts->links() }}
    </div>
</x-app-layout>
