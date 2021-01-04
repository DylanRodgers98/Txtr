<x-box>
    <a href="{{ route('users.show', ['user' => $user]) }}">
        @if (Auth::user()->admin)
            <form class="float-right ml-1" method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                @csrf
                @method('DELETE')
                <input class="float-right bg-white cursor-pointer" type="submit" value="Delete">
            </form>
        @endif
        <img src="{{ $user->profile->profileImage->url ?? "https://i.stack.imgur.com/l60Hf.png" }}"
            class="float-left rounded-full h-24 w-24 mb-6 mr-6"
            alt="{{ $user->profile->display_name }}'s Profile Picture">
        <div>
            <b>{{ $user->profile->display_name }}</b>
        </div>
        <div class="pb-2">
            <i>{{ '@' . $user->username }}</i>
        </div>
        <p>{{ $user->profile->bio }}</p>
    </a>
    @if ($user->id !== Auth::id())
        <div class="pt-2">
            <follow-button :profile-user-id="{{ $user->id }}"
                :auth-user-id="{{ Auth::id() }}">
            </follow-button>
        </div>
    @endif
</x-box>
