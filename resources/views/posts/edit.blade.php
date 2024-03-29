@section('title', 'Edit Post')

<x-app-layout>
    <x-page-title>
        <div class="mx-6 my-4">
            <b>Edit Post</b>
        </div>
    </x-page-title>

    <div class="py-1">
        <x-box>
            <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input id="postBody" class="w-full rounded-full" type="text" name="postBody"
                    value="{{ $post->body }}" placeholder="What's happening?" aria-label="Post Body"
                    @keyup='$refs.chars.updateCharCount()' @change='$refs.chars.updateCharCount()'>

                @if ($post->image)
                    <div class="pt-2">
                        <a href="{{ $post->image->url }}">
                            <img src="{{ $post->image->url }}" class="h-auto w-96 mx-auto"
                                alt="{{ "Image attached to @" . $post->user->username . "'s post" }}">
                        </a>
                    </div>
                @endif

                <div class="float-left my-4">
                    <label for="image">
                        @if ($post->image) Change @else Add an @endif image:
                    </label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <input class="float-right bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                    type="submit" value="Edit Post">
            </form>

            <div class="float-right">
                <character-count-updater ref="chars"
                    char-count-element-id="postBody"
                    :max-chars="140">
                </character-count-updater>
                <a href="{{ route('posts.show', ['post' => $post]) }}">
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer">
                        Back
                    </button>
                </a>
            </div>
        </x-box>
    </div>
</x-app-layout>
