@section('title', 'Edit Profile')

<x-app-layout>
    <x-page-title>
        <div class="mx-6 my-4">
            <b>Edit Profile</b>
        </div>
    </x-page-title>

    <div class="py-1">
        <x-box>
            <form method="POST" action="{{ route('users.profile.update', ['user' => $user]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="pb-4">
                    <label for="profileImage">
                        @if ($user->profile->profileImage) Change @else Add a @endif profile image:
                    </label>
                    <input type="file" id="profileImage" name="profileImage" accept="image/*">
                </div>

                <div class="pb-2">
                    <label for="displayName">Display Name:</label>
                    <div class="float-right">
                        <character-count-updater ref="displayNameChars"
                            char-count-element-id="displayName"
                            :max-chars="50">
                        </character-count-updater>
                    </div>
                    <input class="w-full rounded-full" type="text" id="displayName" name="displayName"
                        value="{{ old('displayName') ?? $user->profile->display_name }}"
                        @keyup='$refs.displayNameChars.updateCharCount()'
                        @change='$refs.displayNameChars.updateCharCount()'>
                </div>

                <div class="pb-2">
                    <label for="bio">Bio:</label>
                    <div class="float-right">
                        <character-count-updater ref="bioChars"
                            char-count-element-id="bio"
                            :max-chars="140">
                        </character-count-updater>
                    </div>
                    <input class="w-full rounded-full" type="text" id="bio" name="bio"
                        value="{{ old('bio') ?? $user->profile->bio }}"
                        @keyup='$refs.bioChars.updateCharCount()'
                        @change='$refs.bioChars.updateCharCount()'>
                </div>

                <div class="pb-2">
                    <label for="location">Location:</label>
                    <div class="float-right">
                        <character-count-updater ref="locationChars"
                            char-count-element-id="location"
                            :max-chars="30">
                        </character-count-updater>
                    </div>
                    <input class="w-full rounded-full" type="text" id="location" name="location"
                        value="{{ old('location') ?? $user->profile->location }}"
                        @keyup='$refs.locationChars.updateCharCount()'
                        @change='$refs.locationChars.updateCharCount()'>
                </div>

                <div class="pb-2">
                    <label for="websiteUrl">Website:</label>
                    <div class="float-right">
                        <character-count-updater ref="websiteUrlChars"
                            char-count-element-id="websiteUrl"
                            :max-chars="100">
                        </character-count-updater>
                    </div>
                    <input class="w-full rounded-full" type="text" id="websiteUrl" name="websiteUrl"
                        value="{{ old('websiteUrl') ?? $user->profile->website_url }}"
                        @keyup='$refs.websiteUrlChars.updateCharCount()'
                        @change='$refs.websiteUrlChars.updateCharCount()'>
                </div>

                <div class="pb-2 float-right">
                    <input class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                        type="submit" value="Edit Profile">
                </div>
            </form>
            <a href="{{ route('users.show', ['user' => $user]) }}">
                <button class="float-right bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer">
                    Back
                </button>
            </a>
        </x-box>
    </div>
</x-app-layout>
