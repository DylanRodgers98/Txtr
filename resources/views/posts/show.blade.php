@section('title', ($post->user->profile->display_name ?? $user->username) . "'s Post")

<x-app-layout>
    <div class="py-1">
        @foreach ($post->parentPosts() as $parentPost)
            <x-post-component :post="$parentPost"/>
        @endforeach

        <div id="post">
            <x-post-component :post="$post">
                <form class="py-2" method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <input type="hidden" name="userId" value="{{ Auth::id() }}">
                    <input type="hidden" name="parentPostId" value="{{ $post->id }}">
                    <input id="postBody" class="w-full rounded-full" type="text" name="postBody"
                        placeholder="{{ "Reply to @" . $post->user->username . "..." }}" value="{{ old('postBody') }}"
                        @keyup='updateCharCount()' @change='updateCharCount()'>
                    <div class="float-right">
                        Characters remaining: @{{ postCharsRemaining }}
                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                            type="submit" value="Post">
                    </div>
                </form>
            </x-post-component>
        </div>

        @foreach ($post->replies as $reply)
            <x-post-component :post="$reply"/>
        @endforeach
    </div>

    <script>
        var app = new Vue({
            el: "#root",
            data: {
                maxPostChars: 140,
                postCharsRemaining: 140
            },
            methods: {
                updateCharCount: function() {
                    const postBodyLength = document.getElementById('postBody').value.length;
                    this.postCharsRemaining = this.maxPostChars - postBodyLength;
                }
            },
            beforeMount() {
                this.updateCharCount();
            }
        });
    </script>
</x-app-layout>
