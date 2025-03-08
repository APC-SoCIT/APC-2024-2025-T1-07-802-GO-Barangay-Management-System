<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $stats = [
            'residents' => $this->getResidentStats(),
            'documents' => $this->getDocumentStats(),
            'news' => $this->getNewsStats(),
            'charts' => $this->getChartData()
        ];

        return view('admin.reports.index', compact('stats'));
    }

    private function getChartData()
    {
        return [
            'documentTypes' => $this->getDocumentTypeDistribution(),
            'responseTimes' => $this->getResponseTimeTrend(),
            'registrationTrend' => $this->getRegistrationTrend()
        ];
    }

    private function getDocumentTypeDistribution()
    {
        try {
            $types = [
                'Barangay Clearance', 
                'Business Permit', 
                'Certificate of Residency', 
                'Indigency Certificate'
            ];
            
            $results = Document::select('type', DB::raw('count(*) as total'))
                ->whereIn('type', $types)
                ->groupBy('type')
                ->pluck('total', 'type')
                ->toArray();
            
            // Initialize with zeros for all types
            $data = array_fill_keys($types, 0);
            
            // Update with actual counts where available
            return array_merge($data, $results);
        } catch (\Exception $e) {
            return array_fill_keys([
                'Barangay Clearance', 
                'Business Permit', 
                'Certificate of Residency', 
                'Indigency Certificate'
            ], 0);
        }
    }

    private function getResponseTimeTrend()
    {
        try {
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            $months = collect(range(0, 5))->map(function($month) use ($sixMonthsAgo) {
                return $sixMonthsAgo->copy()->addMonths($month)->format('M');
            });
            
            $results = Document::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_time')
                )
                ->where('created_at', '>=', $sixMonthsAgo)
                ->where('status', 'completed')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [Carbon::create()->month($item->month)->format('M') => round($item->avg_time ?? 0, 1)];
                })->toArray();
                
            // Ensure all months have values
            return $months->mapWithKeys(function ($month) use ($results) {
                return [$month => $results[$month] ?? 0];
            });
        } catch (\Exception $e) {
            // Return last 6 months with zero values
            return collect(range(0, 5))->mapWithKeys(function($month) use ($sixMonthsAgo) {
                return [$sixMonthsAgo->copy()->addMonths($month)->format('M') => 0];
            });
        }
    }

    private function getRegistrationTrend()
    {
        try {
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            
            return Resident::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('created_at', '>=', $sixMonthsAgo)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [Carbon::create()->month($item->month)->format('M') => $item->total];
                });
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getResidentStats()
    {
        try {
            $total = Resident::count();

            // Get actual religion counts directly from database
            $religionCounts = Resident::select('religion', DB::raw('count(*) as total'))
                ->whereNotNull('religion')
                ->groupBy('religion')
                ->pluck('total', 'religion')
                ->toArray();

            // Get actual civil status counts directly from database
            $civilStatusCounts = Resident::select('civil_status', DB::raw('count(*) as total'))
                ->whereNotNull('civil_status')
                ->groupBy('civil_status')
                ->pluck('total', 'civil_status')
                ->toArray();

            return [
                'total' => $total,
                'by_gender' => [
                    'male' => Resident::where('gender', 'male')->count(),
                    'female' => Resident::where('gender', 'female')->count(),
                    'others' => Resident::whereNotIn('gender', ['male', 'female'])->count()
                ],
                'by_age' => [
                    'youth' => Resident::where('age', '<', 18)->count(),
                    'adult' => Resident::whereBetween('age', [18, 59])->count(),
                    'senior' => Resident::where('age', '>=', 60)->count()
                ],
                'by_religion' => $religionCounts,
                'by_civil_status' => $civilStatusCounts
            ];
        } catch (\Exception $e) {
            return [
                'total' => 0,
                'by_gender' => ['male' => 0, 'female' => 0, 'others' => 0],
                'by_age' => ['youth' => 0, 'adult' => 0, 'senior' => 0],
                'by_religion' => [],
                'by_civil_status' => []
            ];
        }
    }

    // ... existing getDocumentStats(), and getNewsStats() methods ...
}
