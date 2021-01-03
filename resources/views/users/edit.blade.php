@section('title', 'Settings')

<x-app-layout>
    <x-page-title>
        <div class="mx-6 my-4">
            <b>Settings</b>
        </div>
    </x-page-title>

    <div class="py-1">
        <x-box>
            <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
                @csrf
                @method('PUT')
                <div class="pb-2">
                    <label for="username">Username:</label>
                    <div class="float-right">
                        <character-count-updater ref="usernameChars"
                            char-count-element-id="username"
                            :max-chars="50">
                        </character-count-updater>
                    </div>
                    <input class="w-full rounded-full" type="text" id="username" name="username"
                        value="{{ old('username') ?? $user->username }}"
                        @keyup='$refs.usernameChars.updateCharCount()'
                        @change='$refs.usernameChars.updateCharCount()'>
                </div>

                <div class="pb-2">
                    <label for="email">Email:</label>
                    <div class="float-right">
                        <character-count-updater ref="emailChars"
                            char-count-element-id="email"
                            :max-chars="255">
                        </character-count-updater>
                    </div>
                    <input class="w-full rounded-full" type="email" id="email" name="email"
                        value="{{ old('email') ?? $user->email }}"
                        @keyup='$refs.emailChars.updateCharCount()'
                        @change='$refs.emailChars.updateCharCount()'>
                </div>

                <div class="pb-2">
                    <label for="password">Password:</label>
                    <input class="w-full rounded-full" type="password" id="password" name="password">
                </div>

                <div class="pb-2">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input class="w-full rounded-full" type="password" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="pb-2 float-right">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                        type="submit" value="Edit Settings">
                </div>
            </form>
            <a href="{{ route('users.show', ['user' => $user]) }}">
                <button class="float-right bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer">
                    Back
                </button>
            </a>
        </x-box>

        <x-box>
            <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}">
                @csrf
                @method('DELETE')
                <input class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer"
                    type="submit" value="Delete Account">
            </form>
        </x-box>
    </div>
</x-app-layout>
