@section('title', 'Edit Profile')

<x-app-layout>
    <div class="py-1">
        <x-box>
            <form method="POST" action="{{ route('users.profile.update', ['user' => $user]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="pb-4">
                    <label for="bannerImage">
                        @if ($user->profile->bannerImage) Change @else Add a @endif banner image:
                    </label>
                    <input type="file" id="bannerImage" name="bannerImage" accept="image/*">
                </div>

                <div class="pb-4">
                    <label for="profileImage">
                        @if ($user->profile->profileImage) Change @else Add a @endif profile image:
                    </label>
                    <input type="file" id="profileImage" name="profileImage" accept="image/*">
                </div>

                <div class="pb-2">
                    <label for="displayName">Display Name:</label>
                    <div class="float-right">
                        <character-count ref="displayNameChars" text-element="displayName" :max-chars="50"></character-count>
                    </div>
                    <input class="w-full rounded-full" type="text" id="displayName" name="displayName"
                        value="{{ old('displayName') ?? $user->profile->display_name }}">
                </div>

                <div class="pb-2">
                    <label for="bio">Bio:</label>
                    <div class="float-right">
                        <character-count ref="bioChars" text-element="bio" :max-chars="140"></character-count>
                    </div>
                    <input class="w-full rounded-full" type="text" id="bio" name="bio"
                        value="{{ old('bio') ?? $user->profile->bio }}">
                </div>

                <div class="pb-2">
                    <label for="location">Location:</label>
                    <div class="float-right">
                        <character-count ref="locationChars" text-element="location" :max-chars="30"></character-count>
                    </div>
                    <input class="w-full rounded-full" type="text" id="location" name="location"
                        value="{{ old('location') ?? $user->profile->location }}">
                </div>

                <div class="pb-2">
                    <label for="websiteUrl">Website:</label>
                    <div class="float-right">
                        <character-count ref="websiteUrlChars" text-element="websiteUrl" :max-chars="100"></character-count>
                    </div>
                    <input class="w-full rounded-full" type="text" id="websiteUrl" name="websiteUrl"
                        value="{{ old('websiteUrl') ?? $user->profile->website_url }}">
                </div>

                <div class="pb-2 float-right">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
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
