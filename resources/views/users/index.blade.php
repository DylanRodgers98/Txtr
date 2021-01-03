@section('title', 'Users')

<x-app-layout>
    <div class="py-1">
        @foreach ($users as $user)
            <x-user-summary :user="$user"/>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
