@section('title', "Home")

<x-app-layout>
    <x-box>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <input type="hidden" name="userId" value="{{ $user->id }}">
            <input id="postBody" class="w-full rounded-full" type="text" name="postBody"
                value="{{ old('postBody') }}" placeholder="What's happening?"
                @keyup='updateCharCount()' @change='updateCharCount()'>
            <div class="float-right">
                Characters remaining: @{{ postCharsRemaining }}
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                    type="submit" value="Post">
            </div>
        </form>
    </x-box>

    <div class="pb-1">
        @foreach ($posts as $post)
            <x-post-component :post="$post"/>
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
