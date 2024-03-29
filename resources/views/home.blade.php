@section('title', "Home")

<x-app-layout>
    <div class="py-1">
        <x-box>
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="userId" value="{{ $user->id }}">
                <input id="postBody" class="w-full rounded-full" type="text" name="postBody"
                    value="{{ old('postBody') }}" placeholder="What's happening?" aria-label="Post Body"
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
                    <input class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 ml-2 my-2 rounded-full cursor-pointer"
                        type="submit" value="Post">
                </div>
            </form>
        </x-box>

        @foreach ($posts as $post)
            <x-post :post="$post"/>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
