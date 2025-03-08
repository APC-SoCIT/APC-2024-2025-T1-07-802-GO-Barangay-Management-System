@extends('admin.dashboard')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Analytics & Reports</h1>
    <p class="page-description text-muted">Comprehensive overview of barangay activities and statistics</p>
</div>

<div class="row">
    <!-- Quick Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-primary text-white">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-users fa-2x"></i></div>
                <h5 class="card-title mt-3">Total Residents</h5>
                <h2 class="mb-2">{{ number_format($stats['residents']['total']) }}</h2>
                <small>Active members of the barangay</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-success text-white">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-file-alt fa-2x"></i></div>
                <h5 class="card-title mt-3">Documents Processed</h5>
                <h2 class="mb-2">{{ number_format($stats['documents']['processed']['month']) }}</h2>
                <small>In the last 30 days</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-info text-white">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-user-clock fa-2x"></i></div>
                <h5 class="card-title mt-3">Active Users</h5>
                <h2 class="mb-2">{{ number_format($stats['residents']['recent_activity']['week']) }}</h2>
                <small>In the last 7 days</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-warning text-white">
            <div class="card-body">
                <div class="stat-icon"><i class="fas fa-clock fa-2x"></i></div>
                <h5 class="card-title mt-3">Avg. Processing Time</h5>
                <h2 class="mb-2">{{ round($stats['documents']['processing_time']['average'], 1) }}h</h2>
                <small>For document requests</small>
            </div>
        </div>
    </div>

    <!-- Demographics Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title mb-0">Resident Demographics</h3>
            </div>
            <div class="card-body">
                <!-- Gender Distribution -->
                <div class="mb-4">
                    <h5 class="text-muted mb-3">Gender Distribution</h5>
                    <div class="progress rounded-pill mb-3" style="height: 25px;">
                        @php
                            $total = $stats['residents']['total'] ?: 1;
                            $malePercentage = ($stats['residents']['by_gender']['male'] / $total) * 100;
                            $femalePercentage = ($stats['residents']['by_gender']['female'] / $total) * 100;
                        @endphp
                        <div class="progress-bar bg-gradient-primary" style="width: {{ $malePercentage }}%">
                            Male ({{ number_format($stats['residents']['by_gender']['male']) }})
                        </div>
                        <div class="progress-bar bg-gradient-pink" style="width: {{ $femalePercentage }}%">
                            Female ({{ number_format($stats['residents']['by_gender']['female']) }})
                        </div>
                    </div>
                </div>

                <!-- Age Groups -->
                <div>
                    <h5 class="text-muted mb-3">Age Groups</h5>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="p-3 border rounded bg-light">
                                <h3 class="text-primary">{{ number_format($stats['residents']['by_age']['youth']) }}</h3>
                                <small class="text-muted">Youth (<18)</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 border rounded bg-light">
                                <h3 class="text-success">{{ number_format($stats['residents']['by_age']['adult']) }}</h3>
                                <small class="text-muted">Adults (18-59)</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 border rounded bg-light">
                                <h3 class="text-info">{{ number_format($stats['residents']['by_age']['senior']) }}</h3>
                                <small class="text-muted">Seniors (60+)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Statistics Card -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title mb-0">Document Processing Statistics</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="stats-box p-3 rounded bg-light mb-3">
                            <h5 class="text-muted">Weekly Statistics</h5>
                            <div class="mt-3">
                                <p class="mb-2">Requested: <span class="font-weight-bold">{{ number_format($stats['documents']['requested']['week']) }}</span></p>
                                <p class="mb-2">Processed: <span class="font-weight-bold">{{ number_format($stats['documents']['processed']['week']) }}</span></p>
                                <p class="mb-0 text-success">Success Rate: 
                                    @php
                                        $weeklyRate = $stats['documents']['requested']['week'] > 0 
                                            ? ($stats['documents']['processed']['week'] / $stats['documents']['requested']['week']) * 100 
                                            : 0;
                                    @endphp
                                    <span class="font-weight-bold">{{ round($weeklyRate) }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stats-box p-3 rounded bg-light">
                            <h5 class="text-muted">Monthly Statistics</h5>
                            <div class="mt-3">
                                <p class="mb-2">Requested: <span class="font-weight-bold">{{ number_format($stats['documents']['requested']['month']) }}</span></p>
                                <p class="mb-2">Processed: <span class="font-weight-bold">{{ number_format($stats['documents']['processed']['month']) }}</span></p>
                                <p class="mb-0 text-success">Success Rate: 
                                    @php
                                        $monthlyRate = $stats['documents']['requested']['month'] > 0 
                                            ? ($stats['documents']['processed']['month'] / $stats['documents']['requested']['month']) * 100 
                                            : 0;
                                    @endphp
                                    <span class="font-weight-bold">{{ round($monthlyRate) }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News Updates Card -->
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title mb-0">Recent News & Updates</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="text-muted mb-3">Latest News ({{ number_format($stats['news']['total']) }} total posts)</h5>
                        <div class="news-list">
                            @foreach($stats['news']['recent'] as $news)
                                <div class="news-item p-3 mb-2 rounded bg-light">
                                    <h6 class="mb-1">{{ $news->title }}</h6>
                                    <small class="text-muted">{{ $news->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-muted mb-3">News Engagement</h5>
                        <div class="engagement-stats">
                            <div class="p-3 rounded bg-light mb-3">
                                <h4 class="mb-1">{{ number_format($stats['news']['engagement']['week']) }}</h4>
                                <small class="text-muted">New posts this week</small>
                            </div>
                            <div class="p-3 rounded bg-light">
                                <h4 class="mb-1">{{ number_format($stats['news']['engagement']['month']) }}</h4>
                                <small class="text-muted">New posts this month</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}
.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #13855c);
}
.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391);
}
.bg-gradient-warning {
    background: linear-gradient(45deg, #f6c23e, #dda20a);
}
.bg-gradient-pink {
    background: linear-gradient(45deg, #e83e8c, #ba2167);
}
.stat-card {
    border: none;
    transition: transform 0.2s;
}
.stat-card:hover {
    transform: translateY(-5px);
}
.stat-icon {
    opacity: 0.8;
}
.progress {
    overflow: visible;
}
.progress-bar {
    transition: width 1s;
    position: relative;
    overflow: visible;
    font-weight: 500;
    line-height: 25px;
}
.stats-box {
    transition: transform 0.2s;
}
.stats-box:hover {
    transform: translateY(-3px);
}
.news-item {
    transition: transform 0.2s;
}
.news-item:hover {
    transform: translateX(5px);
    background-color: #f8f9fa !important;
}
.card {
    border: none;
    transition: all 0.2s;
}
.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
.font-weight-bold {
    font-weight: 600 !important;
}
</style>
@endsection
