<?php

namespace App\Http\Controllers;

use App\Models\News; // Ensure you have a News model
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch the latest news articles from the database
        $newsArticles = News::latest()->take(3)->get(); // Fetch the latest 3 articles

        // Pass the news articles to the welcome view
        return view('welcome', compact('newsArticles'));
    }
}