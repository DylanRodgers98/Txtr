@section('title', 'Notifications')

<x-app-layout>
    <div class="py-1">
        @foreach ($paginatedNotifications as $notification)
            <x-box>
                <p>{{ $notification->type }}</p>
                @foreach ($notification->data as $data)
                    <p>{{ $data }}</p>
                @endforeach
            </x-box>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $paginatedNotifications->links() }}
        </div>
    </div>
</x-app-layout>
