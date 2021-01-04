<?php

namespace App;

use Illuminate\Support\Facades\Http;

class NewsApi
{
    public function topHeadlines()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => env('NEWS_API_KEY'),
            'language' => 'en'
        ]);
        return $response->json()['articles'];
    }
}
