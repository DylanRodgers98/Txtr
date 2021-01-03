<a href="{{ route('users.show', ['user' => $user]) }}">
    <x-box>
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
    </x-box>
</a>
