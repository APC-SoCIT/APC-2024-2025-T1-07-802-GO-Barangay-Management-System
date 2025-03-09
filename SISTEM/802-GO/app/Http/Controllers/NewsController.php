<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Display the latest news
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }

    // Display a single news article
    public function show($id)
{
    $news = News::findOrFail($id);
    $previousNews = News::where('id', '<', $news->id)->orderBy('id', 'desc')->first();
    $nextNews = News::where('id', '>', $news->id)->orderBy('id', 'asc')->first();

    return view('news.show', compact('news', 'previousNews', 'nextNews'));
}
}