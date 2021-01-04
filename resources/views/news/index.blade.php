@section('title', 'News')

<x-app-layout>
    <div class="py-1">
        @foreach ($articles as $article)
            <a href="{{ $article['url'] }}" target="_blank" rel="noopener noreferrer">
                <x-box>
                    <div>
                        <b>{{ $article['source']['name'] }}: {{ $article['title'] }}</b>
                    </div>
                    <p>{{ $article['description'] }}</p>
                </x-box>
            </a>
        @endforeach
    </div>
</x-app-layout>
