@section('title', "Home")

<x-app-layout>
    <x-box>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input class="w-full rounded-full" type="text" name="body"
                placeholder="What's happening?" value="{{ old('body') }}">
            <input class="float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-2 rounded-full cursor-pointer"
                type="submit" value="Post">
        </form>
    </x-box>

    <div class="pb-1">
        @foreach ($posts as $post)
            <x-post-component :post="$post"/>
        @endforeach
    </div>
</x-app-layout>
