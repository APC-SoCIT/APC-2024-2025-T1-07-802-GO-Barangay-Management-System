<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\DocumentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $weekAgo = $now->copy()->subWeek();
        $monthAgo = $now->copy()->subMonth();

        $stats = [
            'residents' => [
                'total' => User::where('is_admin', false)->count(),
                'by_gender' => [
                    'male' => User::where('is_admin', false)->where('gender', 'Male')->count(),
                    'female' => User::where('is_admin', false)->where('gender', 'Female')->count(),
                ],
                'by_age' => [
                    'youth' => User::where('is_admin', false)->where('age', '<', 18)->count(),
                    'adult' => User::where('is_admin', false)->whereBetween('age', [18, 59])->count(),
                    'senior' => User::where('is_admin', false)->where('age', '>=', 60)->count(),
                ],
                'recent_activity' => [
                    'week' => User::where('is_admin', false)
                        ->where('created_at', '>=', $weekAgo)
                        ->count(),
                    'month' => User::where('is_admin', false)
                        ->where('created_at', '>=', $monthAgo)
                        ->count(),
                ]
            ],
            'documents' => [
                'requested' => [
                    'week' => DocumentRequest::where('created_at', '>=', $weekAgo)->count(),
                    'month' => DocumentRequest::where('created_at', '>=', $monthAgo)->count(),
                ],
                'processed' => [
                    'week' => DocumentRequest::where('status', 'completed')
                        ->where('updated_at', '>=', $weekAgo)->count(),
                    'month' => DocumentRequest::where('status', 'completed')
                        ->where('updated_at', '>=', $monthAgo)->count(),
                ],
                'by_type' => DocumentRequest::select('document_type')
                    ->selectRaw('COUNT(*) as count')
                    ->groupBy('document_type')
                    ->get()
                    ->pluck('count', 'document_type')
                    ->toArray(),
                'processing_time' => [
                    'average' => DocumentRequest::where('status', 'completed')
                        ->where('updated_at', '>=', $monthAgo)
                        ->avg(\DB::raw('TIMESTAMPDIFF(HOUR, created_at, updated_at)')) ?? 0
                ]
            ],
            'news' => [
                'total' => News::count(),
                'recent' => News::latest()->take(5)->get(),
                'engagement' => [
                    'week' => News::where('created_at', '>=', $weekAgo)->count(),
                    'month' => News::where('created_at', '>=', $monthAgo)->count(),
                ]
            ]
        ];

        return view('admin.reports.index', compact('stats'));
    }
}
