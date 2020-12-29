@section('title', ($post->user->profile->display_name ?? $user->username) . "'s Post")

<x-app-layout>
    <div class="py-1">
        @foreach ($post->parentPosts() as $parentPost)
            <x-post-component :post="$parentPost"/>
        @endforeach

        <x-post-component :post="$post">
            <div class="py-2">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <input type="hidden" name="userId" value="{{ Auth::id() }}">
                    <input type="hidden" name="parentPostId" value="{{ $post->id }}">
                    <input class="w-full rounded-full" type="text" name="postBody"
                        placeholder="{{ "Reply to @" . $post->user->username . "..." }}" value="{{ old('postBody') }}">
                    <input class="float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-2 rounded-full cursor-pointer"
                        type="submit" value="Reply">
                </form>
            </div>
        </x-post-component>

        @foreach ($post->replies as $reply)
            <x-post-component :post="$reply"/>
        @endforeach
    </div>
</x-app-layout>
