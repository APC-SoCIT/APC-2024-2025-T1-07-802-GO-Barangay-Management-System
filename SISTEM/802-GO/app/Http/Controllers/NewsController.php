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
    public function show(News $news)
    {
        // Increment the view count
        $news->incrementResidentViews();
        
        return view('news.show', compact('news'));
    }
}