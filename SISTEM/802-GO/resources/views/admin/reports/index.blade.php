@extends('admin.dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Analytics & Reports</h1>
    <p class="page-description">Comprehensive overview of barangay activities and statistics</p>
</div>

<div class="row">
    <!-- Quick Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Residents</h5>
                <h2 class="mb-0">{{ $stats['residents']['total'] }}</h2>
                <small>Active members of the barangay</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Documents Processed</h5>
                <h2 class="mb-0">{{ $stats['documents']['processed']['month'] }}</h2>
                <small>In the last 30 days</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Active Users</h5>
                <h2 class="mb-0">{{ $stats['residents']['recent_activity']['week'] }}</h2>
                <small>In the last 7 days</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">Avg. Processing Time</h5>
                <h2 class="mb-0">{{ round($stats['documents']['processing_time']['average'], 1) }}h</h2>
                <small>For document requests</small>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Resident Demographics</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5>Gender Distribution</h5>
                    <div class="progress mb-2" style="height: 25px;">
                        @php
                            $malePercentage = ($stats['residents']['by_gender']['male'] / $stats['residents']['total']) * 100;
                            $femalePercentage = ($stats['residents']['by_gender']['female'] / $stats['residents']['total']) * 100;
                        @endphp
                        <div class="progress-bar bg-primary" style="width: {{ $malePercentage }}%">
                            Male ({{ round($malePercentage) }}%)
                        </div>
                        <div class="progress-bar bg-pink" style="width: {{ $femalePercentage }}%">
                            Female ({{ round($femalePercentage) }}%)
                        </div>
                    </div>
                </div>

                <div>
                    <h5>Age Groups</h5>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="p-3 border rounded">
                                <h3 class="text-primary">{{ $stats['residents']['by_age']['youth'] }}</h3>
                                <small>Youth (<18)</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 border rounded">
                                <h3 class="text-success">{{ $stats['residents']['by_age']['adult'] }}</h3>
                                <small>Adults (18-59)</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 border rounded">
                                <h3 class="text-info">{{ $stats['residents']['by_age']['senior'] }}</h3>
                                <small>Seniors (60+)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Document Processing Statistics</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-6">
                        <h5>Weekly Statistics</h5>
                        <p>Requested: {{ $stats['documents']['requested']['week'] }}</p>
                        <p>Processed: {{ $stats['documents']['processed']['week'] }}</p>
                        <p class="text-success">Success Rate: 
                            @php
                                $weeklyRate = $stats['documents']['requested']['week'] > 0 
                                    ? ($stats['documents']['processed']['week'] / $stats['documents']['requested']['week']) * 100 
                                    : 0;
                            @endphp
                            {{ round($weeklyRate) }}%
                        </p>
                    </div>
                    <div class="col-6">
                        <h5>Monthly Statistics</h5>
                        <p>Requested: {{ $stats['documents']['requested']['month'] }}</p>
                        <p>Processed: {{ $stats['documents']['processed']['month'] }}</p>
                        <p class="text-success">Success Rate: 
                            @php
                                $monthlyRate = $stats['documents']['requested']['month'] > 0 
                                    ? ($stats['documents']['processed']['month'] / $stats['documents']['requested']['month']) * 100 
                                    : 0;
                            @endphp
                            {{ round($monthlyRate) }}%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News and Updates -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent News & Updates</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Latest News ({{ $stats['news']['total'] }} total posts)</h5>
                        <ul class="list-group">
                            @foreach($stats['news']['recent'] as $news)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $news->title }}
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $news->created_at->diffForHumans() }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>News Engagement</h5>
                        <div class="p-3 border rounded mb-3">
                            <h4>{{ $stats['news']['engagement']['week'] }}</h4>
                            <small>New posts this week</small>
                        </div>
                        <div class="p-3 border rounded">
                            <h4>{{ $stats['news']['engagement']['month'] }}</h4>
                            <small>New posts this month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-pink {
    background-color: #ff69b4;
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.progress {
    border-radius: 1rem;
}
.progress-bar {
    transition: width 1s;
    text-align: center;
    line-height: 25px;
}
</style>
@endsection
