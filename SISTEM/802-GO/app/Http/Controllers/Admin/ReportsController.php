<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $stats = [
            'total_residents' => User::where('is_admin', false)->count(),
            'total_news' => News::count(),
            'recent_news' => News::latest()->take(5)->get(),
            'residents_by_gender' => [
                'male' => User::where('is_admin', false)->where('gender', 'Male')->count(),
                'female' => User::where('is_admin', false)->where('gender', 'Female')->count(),
            ],
            'residents_by_age' => [
                'youth' => User::where('is_admin', false)->where('age', '<', 18)->count(),
                'adult' => User::where('is_admin', false)->whereBetween('age', [18, 59])->count(),
                'senior' => User::where('is_admin', false)->where('age', '>=', 60)->count(),
            ],
        ];

        return view('admin.reports.index', compact('stats'));
    }
}
