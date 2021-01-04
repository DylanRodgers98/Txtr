<?php

namespace App\Http\Controllers;

use App\NewsApi;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsApi $newsApi)
    {
        $articles = $newsApi->topHeadlines();
        return view('news.index', ['articles' => $articles]);
    }
}
