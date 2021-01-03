@section('title', 'Notifications')

<x-app-layout>
    <div class="py-1">
        @foreach ($notifications as $notification)
            <a href={{ $notification->notificationUrl }}>
                <x-box>
                    <img src="{{ $notification->notificationImageUrl ?? "https://i.stack.imgur.com/l60Hf.png" }}"
                        class="float-left mr-4 mb-6 rounded-full h-16 w-16" alt="Notification Image">
                    @if ($notification->unread) <b> @endif
                    <p>{{ $notification->heading }}</p>
                    @if ($notification->unread) </b> @endif
                    <i>{{ $notification->subheading }}</i>
                    <p>{{ $notification->timestamp }}</p>
                </x-box>
            </a>
        @endforeach

        <div class="py-1 sm:px-6 lg:px-8">
            {!! $paginationLinks !!}
        </div>
    </div>
</x-app-layout>
