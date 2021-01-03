@section('title', 'Users')

<x-app-layout>
    <x-page-title>
        <div class="mx-6 my-4">
            <b>Users</b>
        </div>
    </x-page-title>

    <div class="py-1">
        @foreach ($users as $user)
            <x-user-summary :user="$user"/>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
