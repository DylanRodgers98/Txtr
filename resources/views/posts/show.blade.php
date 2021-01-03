@section('title', ($post->user->profile->display_name ?? $user->username) . "'s Post")

<x-app-layout>
    <div class="py-1">
        @foreach ($post->parentPosts() as $parentPost)
            <x-post :post="$parentPost"/>
        @endforeach

        <div id="post">
            <x-post :post="$post">
                <form class="py-2" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{ Auth::id() }}">
                    <input type="hidden" name="parentPostId" value="{{ $post->id }}">
                    <input id="postBody" class="w-full rounded-full" type="text" name="postBody"
                        placeholder="{{ "Reply to @" . $post->user->username . "..." }}" value="{{ old('postBody') }}"
                        @keyup='$refs.chars.updateCharCount()' @change='$refs.chars.updateCharCount()'>
                    <div class="float-left my-4">
                        <label for="image">Add an image:</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="float-right">
                        <character-count-updater ref="chars"
                            char-count-element-id="postBody"
                            :max-chars="140">
                        </character-count-updater>
                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                            type="submit" value="Reply">
                    </div>
                </form>
            </x-post>
        </div>

        @foreach ($post->replies as $reply)
            <x-post :post="$reply"/>
        @endforeach
    </div>
</x-app-layout>
