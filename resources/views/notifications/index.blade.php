@section('title', 'Notifications')

<x-app-layout>
    <div class="py-1">
        @foreach ($displayableNotifications as $notification)
            <a href={{ $notification->notificationUrl }}>
                <x-box>
                    <img src="{{ $notification->profileImagePath ?? "https://i.stack.imgur.com/l60Hf.png" }}"
                        class="float-left mr-4 rounded-full h-16 w-16"
                        alt="Notification Picture">
                    <b>{{ $notification->heading }}</b>
                    <p>{{ $notification->subheading }}</p>
                    <p>{{ $notification->timestamp }}</p>
                </x-box>
            </a>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {{ $notifications->links() }}
        </div>
    </div>
</x-app-layout>
