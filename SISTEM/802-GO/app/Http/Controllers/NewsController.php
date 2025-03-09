<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Display the latest news
    public function index(Request $request)
{
    $search = $request->input('search');

    $news = News::query()
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Explicitly set the base path for pagination
    $news->withPath(route('news.index'));

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

    public function search(Request $request)
{
    $query = $request->input('query');

    // Store the search query in session
    $searchHistory = session('search_history', []);
    if (!empty($query)) {
        array_unshift($searchHistory, $query); // Add new query to the beginning
        $searchHistory = array_slice($searchHistory, 0, 5); // Keep only the last 5 searches
        session(['search_history' => $searchHistory]);
    }

    // Perform the search
    $news = News::where('title', 'like', "%$query%")
                ->orWhere('content', 'like', "%$query%")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    return view('news.index', compact('news', 'searchHistory'));
}
}