@section('title', "Home")

<x-app-layout>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-gray-200">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input class="w-full rounded-full" type="text" name="body"
                            placeholder="What's happening?" value="{{ old('body') }}">
                        <input class="float-right bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-2 rounded-full"
                            type="submit" value="Post">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-1">
        @foreach ($posts as $post)
            <x-post-component :post="$post"/>
        @endforeach
    </div>
</x-app-layout>
