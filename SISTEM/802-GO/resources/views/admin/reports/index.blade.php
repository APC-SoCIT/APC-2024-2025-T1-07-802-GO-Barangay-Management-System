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
            <div class="card-body p-4">
                <div class="stat-icon mb-3"><i class="fas fa-users fa-2x"></i></div>
                <h5 class="card-title">Total Residents</h5>
                <h2 class="stat-value mb-2">{{ number_format($stats['residents']['total']) }}</h2>
                <p class="mb-0"><small>Active members of the barangay</small></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-success text-white">
            <div class="card-body p-4">
                <div class="stat-icon mb-3"><i class="fas fa-file-alt fa-2x"></i></div>
                <h5 class="card-title">Documents Processed</h5>
                <h2 class="stat-value mb-2">{{ number_format($stats['documents']['processed']['month']) }}</h2>
                <p class="mb-0"><small>In the last 30 days</small></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-info text-white">
            <div class="card-body p-4">
                <div class="stat-icon mb-3"><i class="fas fa-user-clock fa-2x"></i></div>
                <h5 class="card-title">Active Users</h5>
                <h2 class="stat-value mb-2">{{ number_format($stats['residents']['recent_activity']['week']) }}</h2>
                <p class="mb-0"><small>In the last 7 days</small></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-gradient-warning text-white">
            <div class="card-body p-4">
                <div class="stat-icon mb-3"><i class="fas fa-clock fa-2x"></i></div>
                <h5 class="card-title">Avg. Processing Time</h5>
                <h2 class="stat-value mb-2">{{ round($stats['documents']['processing_time']['average'], 1) }}h</h2>
                <p class="mb-0"><small>For document requests</small></p>
            </div>
        </div>
    </div>

    <!-- Demographics Card -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title mb-0">Resident Demographics</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Gender Distribution Column -->
                    <div class="col-md-6 mb-4">
                        <h5 class="text-muted mb-3">Gender Distribution</h5>
                        @php
                            $total = $stats['residents']['total'] ?: 1;
                            $maleCount = $stats['residents']['by_gender']['male'];
                            $femaleCount = $stats['residents']['by_gender']['female'];
                            $othersCount = $stats['residents']['by_gender']['others'];
                            $malePercentage = ($maleCount / $total) * 100;
                            $femalePercentage = ($femaleCount / $total) * 100;
                            $othersPercentage = ($othersCount / $total) * 100;
                        @endphp
                        
                        <!-- Male Stats -->
                        <div class="gender-stats mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><i class="fas fa-mars text-primary mr-2"></i> Male</span>
                                <span>{{ number_format($maleCount) }} ({{ round($malePercentage) }}%)</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 25px; background-color: rgba(0,0,0,0.05);">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-gradient-primary" 
                                    role="progressbar" 
                                    style="width: {{ $malePercentage }}%;"
                                    aria-valuenow="{{ $malePercentage }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    <span class="font-weight-bold">{{ round($malePercentage) }}%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Female Stats -->
                        <div class="gender-stats mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><i class="fas fa-venus text-pink mr-2"></i> Female</span>
                                <span>{{ number_format($femaleCount) }} ({{ round($femalePercentage) }}%)</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 25px; background-color: rgba(0,0,0,0.05);">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-gradient-pink" 
                                    role="progressbar" 
                                    style="width: {{ $femalePercentage }}%;"
                                    aria-valuenow="{{ $femalePercentage }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    <span class="font-weight-bold">{{ round($femalePercentage) }}%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Others Stats -->
                        <div class="gender-stats">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><i class="fas fa-transgender-alt text-purple mr-2"></i> Others</span>
                                <span>{{ number_format($othersCount) }} ({{ round($othersPercentage) }}%)</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 25px; background-color: rgba(0,0,0,0.05);">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                    role="progressbar" 
                                    style="width: {{ $othersPercentage }}%; background: linear-gradient(45deg, #9b51e0, #7435aa);"
                                    aria-valuenow="{{ $othersPercentage }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    <span class="font-weight-bold">{{ round($othersPercentage) }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Age Groups Column -->
                    <div class="col-md-6 mb-4">
                        <h5 class="text-muted mb-3">Age Groups</h5>
                        @php
                            $totalResidents = array_sum($stats['residents']['by_age']);
                            $totalResidents = $totalResidents ?: 1; // Prevent division by zero
                            $youthPercentage = ($stats['residents']['by_age']['youth'] / $totalResidents) * 100;
                            $adultPercentage = ($stats['residents']['by_age']['adult'] / $totalResidents) * 100;
                            $seniorPercentage = ($stats['residents']['by_age']['senior'] / $totalResidents) * 100;
                        @endphp
                        
                        <div class="age-groups-container p-4">
                            <!-- Youth Stats -->
                            <div class="age-group-stat mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>
                                        <i class="fas fa-child text-primary mr-2"></i> 
                                        Youth (<18)
                                    </span>
                                    <span>{{ number_format($stats['residents']['by_age']['youth']) }} ({{ round($youthPercentage) }}%)</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 25px; background-color: rgba(0,0,0,0.05);">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-gradient-primary" 
                                         role="progressbar" 
                                         style="width: {{ $youthPercentage }}%"
                                         aria-valuenow="{{ $youthPercentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <span class="font-weight-bold">{{ round($youthPercentage) }}%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Adults Stats -->
                            <div class="age-group-stat mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>
                                        <i class="fas fa-user text-success mr-2"></i> 
                                        Adults (18-59)
                                    </span>
                                    <span>{{ number_format($stats['residents']['by_age']['adult']) }} ({{ round($adultPercentage) }}%)</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 25px; background-color: rgba(0,0,0,0.05);">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-gradient-success" 
                                         role="progressbar" 
                                         style="width: {{ $adultPercentage }}%"
                                         aria-valuenow="{{ $adultPercentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <span class="font-weight-bold">{{ round($adultPercentage) }}%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Seniors Stats -->
                            <div class="age-group-stat">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>
                                        <i class="fas fa-user-plus text-info mr-2"></i> 
                                        Seniors (60+)
                                    </span>
                                    <span>{{ number_format($stats['residents']['by_age']['senior']) }} ({{ round($seniorPercentage) }}%)</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 25px; background-color: rgba(0,0,0,0.05);">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-gradient-info" 
                                         role="progressbar" 
                                         style="width: {{ $seniorPercentage }}%"
                                         aria-valuenow="{{ $seniorPercentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <span class="font-weight-bold">{{ round($seniorPercentage) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Religion Distribution Column -->
                    <div class="col-md-6 mb-4">
                        <h5 class="text-muted mb-3">Religion Distribution</h5>
                        <div class="demographics-section">
                            @php
                                $religionCounts = $stats['residents']['by_religion'] ?? [];
                                $totalReligion = array_sum($religionCounts);
                                $colors = [
                                    'bg-gradient-primary',
                                    'bg-gradient-success',
                                    'bg-gradient-info',
                                    'bg-gradient-warning',
                                    'bg-gradient-pink',
                                    'bg-gradient-danger',
                                    'bg-gradient-secondary'
                                ];
                            @endphp
                            
                            @forelse($religionCounts as $religion => $count)
                                @php
                                    $percentage = $totalReligion > 0 ? ($count / $totalReligion) * 100 : 0;
                                    $colorIndex = $loop->index % count($colors);
                                @endphp
                                <div class="demographic-stat mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span><i class="fas fa-pray mr-2"></i> {{ $religion ?: 'Not Specified' }}</span>
                                        <span>{{ number_format($count) }} ({{ round($percentage) }}%)</span>
                                    </div>
                                    <div class="progress rounded-pill" style="height: 20px; background-color: rgba(0,0,0,0.05);">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $colors[$colorIndex] }}" 
                                             role="progressbar" 
                                             style="width: {{ $percentage }}%">
                                            <span class="font-weight-bold">{{ round($percentage) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted text-center p-3">No religion data available</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Civil Status Distribution Column -->
                    <div class="col-md-6 mb-4">
                        <h5 class="text-muted mb-3">Civil Status Distribution</h5>
                        <div class="demographics-section">
                            @php
                                $civilStatusCounts = $stats['residents']['by_civil_status'] ?? [];
                                $totalCivil = array_sum($civilStatusCounts);
                            @endphp
                            
                            @forelse($civilStatusCounts as $status => $count)
                                @php
                                    $percentage = $totalCivil > 0 ? ($count / $totalCivil) * 100 : 0;
                                    $colorIndex = $loop->index % count($colors);
                                @endphp
                                <div class="demographic-stat mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span><i class="fas fa-heart mr-2"></i> {{ $status ?: 'Not Specified' }}</span>
                                        <span>{{ number_format($count) }} ({{ round($percentage) }}%)</span>
                                    </div>
                                    <div class="progress rounded-pill" style="height: 20px; background-color: rgba(0,0,0,0.05);">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $colors[$colorIndex] }}" 
                                             role="progressbar" 
                                             style="width: {{ $percentage }}%">
                                            <span class="font-weight-bold">{{ round($percentage) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted text-center p-3">No civil status data available</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Statistics Card -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title mb-0">Document Processing Overview</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="text-muted mb-3">Document Type Distribution</h5>
                        <div class="document-types">
                            @php
                                $types = [
                                    'Barangay Clearance' => ['icon' => 'fa-file-alt', 'color' => '#4e73df'],
                                    'Business Permit' => ['icon' => 'fa-store', 'color' => '#1cc88a'],
                                    'Certificate of Residency' => ['icon' => 'fa-home', 'color' => '#36b9cc'],
                                    'Indigency Certificate' => ['icon' => 'fa-hand-holding-heart', 'color' => '#f6c23e']
                                ];
                            @endphp

                            @foreach($types as $type => $meta)
                                <div class="document-stat-box p-3 mb-3 rounded bg-light">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas {{ $meta['icon'] }} mr-2" style="color: {{ $meta['color'] }}"></i>
                                            <span>{{ $type }}</span>
                                        </div>
                                        <div class="font-weight-bold">
                                            {{ number_format($stats['charts']['documentTypes'][$type] ?? 0) }}
                                            <small class="text-muted">requests</small>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 8px;">
                                        <div class="progress-bar" 
                                             style="width: {{ ($stats['charts']['documentTypes'][$type] ?? 0) / max(1, array_sum($stats['charts']['documentTypes'] ?? [])) * 100 }}%; background-color: {{ $meta['color'] }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="stats-box p-3 rounded bg-light">
                            <h6 class="text-muted">Weekly Statistics</h6>
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
                            <h6 class="text-muted">Monthly Statistics</h6>
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

    <!-- News Updates Card - Enhanced UI -->
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center px-4">
                <div class="d-flex align-items-center">
                    <h3 class="card-title mb-0">Recent News & Updates</h3>
                    <span class="badge badge-primary ml-3">{{ number_format($stats['news']['total']) }} Total Posts</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="news-list">
                            @foreach($stats['news']['recent'] as $news)
                                <a href="{{ route('admin.news.show', $news->id) }}" class="news-link">
                                    <div class="news-item p-3 mb-3 bg-light rounded-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="news-icon mr-3">
                                                    <i class="fas fa-newspaper fa-lg text-primary"></i>
                                                </div>
                                                <div class="news-content">
                                                    <h6 class="mb-1 font-weight-bold text-dark">{{ $news->title }}</h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        {{ $news->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                            <i class="fas fa-chevron-right text-primary"></i>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="engagement-stat-card mb-3 bg-primary-light rounded-lg p-4">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon mr-3">
                                    <i class="fas fa-calendar-week fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0 text-primary">{{ number_format($stats['news']['engagement']['week']) }}</h4>
                                    <small class="text-muted">This Week</small>
                                </div>
                            </div>
                        </div>
                        <div class="engagement-stat-card bg-success-light rounded-lg p-4">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon mr-3">
                                    <i class="fas fa-calendar-alt fa-2x text-success"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0 text-success">{{ number_format($stats['news']['engagement']['month']) }}</h4>
                                    <small class="text-muted">This Month</small>
                                </div>
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
    border-radius: 15px;
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card .card-body {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.stat-value {
    font-size: 2rem;
    font-weight: 600;
    line-height: 1.2;
}

.card-title {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.stat-icon {
    opacity: 0.8;
    background: rgba(255,255,255,0.1);
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}
.progress {
    overflow: hidden;
    background-color: rgba(0,0,0,0.05);
    height: 25px;
}
.progress-bar {
    transition: width 1s;
    position: relative;
    font-weight: 500;
    font-size: 0.875rem;
}
.age-group-card {
    border: 1px solid rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.age-group-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.age-label {
    font-size: 0.875rem;
    color: #6c757d;
    line-height: 1.2;
}
.age-icon {
    background: rgba(0,0,0,0.05);
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto;
}
.gender-stats {
    margin-bottom: 1.5rem;
}
.card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    overflow: visible;
}
.card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}
.card-header {
    background: transparent;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.display-4 {
    font-size: 2.5rem;
    font-weight: 600;
}
/* Add spacing between elements */
.mb-5 {
    margin-bottom: 3rem !important;
}
.g-3 {
    gap: 1rem;
}
.rounded-lg {
    border-radius: 1rem !important;
}
.text-purple {
    color: #9b51e0;
}

.mr-2 {
    margin-right: 0.5rem;
}

.progress {
    background-color: #f0f2f5;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.075);
}

.progress-bar {
    transition: width 1s ease;
    position: relative;
    overflow: visible;
    font-weight: 500;
    line-height: 25px;
    font-size: 0.875rem;
}

/* Enhanced UI Styles */
.card {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07) !important;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.card:hover {
    transform: translateY(-5px) translateZ(0);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12) !important;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.stat-card {
    overflow: hidden;
    position: relative;
}

.stat-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
}

.progress-bar {
    position: relative;
    transition: width 1s ease;
    font-weight: 500;
    font-size: 0.875rem;
    line-height: 25px;
    color: white;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.progress-bar-striped {
    background-image: linear-gradient(45deg, 
        rgba(255,255,255,.15) 25%, 
        transparent 25%, 
        transparent 50%, 
        rgba(255,255,255,.15) 50%, 
        rgba(255,255,255,.15) 75%, 
        transparent 75%, 
        transparent);
    background-size: 1rem 1rem;
}

.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

@keyframes progress-bar-stripes {
    from { background-position: 1rem 0; }
    to { background-position: 0 0; }
}

.age-group-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    min-width: 200px;
}

.news-item {
    border-left: 4px solid transparent;
    transition: all 0.2s ease;
}

.news-item:hover {
    border-left-color: #4e73df;
    transform: translateX(5px);
}

.document-stat-box {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.document-stat-box:hover {
    transform: translateX(5px);
    background-color: #f8f9fa !important;
    border-left: 4px solid #4e73df;
}

.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

/* Enhanced Age Groups Styling */
.age-groups-container {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 1rem;
}

.age-group-card {
    background: white;
    border-radius: 1rem;
    min-width: 180px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.age-icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.bg-primary-light { background: rgba(78, 115, 223, 0.1); }
.bg-success-light { background: rgba(28, 200, 138, 0.1); }
.bg-info-light { background: rgba(54, 185, 204, 0.1); }

/* Enhanced Progress Bars */
.progress-bar.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
    box-shadow: 0 2px 4px rgba(78, 115, 223, 0.3);
}

.progress-bar.bg-gradient-pink {
    background: linear-gradient(45deg, #e83e8c 0%, #ba2167 100%);
    box-shadow: 0 2px 4px rgba(232, 62, 140, 0.3);
}

.progress-bar-purple {
    background: linear-gradient(45deg, #9b51e0 0%, #7435aa 100%);
    box-shadow: 0 2px 4px rgba(155, 81, 224, 0.3);
}

/* Enhanced News Items */
.news-item {
    border-left: 4px solid #4e73df;
    transition: all 0.2s ease;
}

.news-item:hover {
    transform: translateX(5px);
    background: white !important;
}

.engagement-stat-card {
    transition: all 0.3s ease;
}

.engagement-stat-card:hover {
    transform: translateY(-3px);
}

.badge-primary {
    background-color: #4e73df;
    color: white;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 2rem;
}

/* Fix Age Groups Progress Bars */
.age-group-stat .progress-bar.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a 0%, #13855c 100%) !important;
    box-shadow: 0 2px 4px rgba(28, 200, 138, 0.3);
}

.age-group-stat .progress-bar.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc 0%, #258391 100%) !important;
    box-shadow: 0 2px 4px rgba(54, 185, 204, 0.3);
}

/* Add styles for new sections */
.religion-container,
.civil-status-container {
    border-radius: 1rem;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
}

.religion-stat .progress-bar,
.civil-status-stat .progress-bar {
    color: white;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

/* Demographics Section Styling */
.demographics-section {
    background: #f8f9fa;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
}

.demographic-stat {
    margin-bottom: 1rem;
}

.demographic-stat:last-child {
    margin-bottom: 0;
}

.demographic-stat .progress-bar {
    font-size: 0.8rem;
    line-height: 20px;
}

.bg-gradient-danger {
    background: linear-gradient(45deg, #e74a3b, #be2617);
}

.bg-gradient-secondary {
    background: linear-gradient(45deg, #858796, #60616f);
}

/* Enhanced News Items Styling */
.news-link {
    text-decoration: none;
    display: block;
}

.news-item {
    border-left: 4px solid #4e73df;
    transition: all 0.2s ease;
    background-color: #f8f9fa;
    position: relative;
    padding-right: 2rem;
}

.news-item:hover {
    transform: translateX(5px);
    background-color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.news-item .fa-chevron-right {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    transition: transform 0.2s ease;
}

.news-item:hover .fa-chevron-right {
    transform: translate(5px, -50%);
}

.news-content h6 {
    color: #1e40af;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
}

.news-icon {
    background: rgba(78, 115, 223, 0.1);
    padding: 0.75rem;
    border-radius: 0.5rem;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Define constants
    const DOCUMENT_TYPES = ['Barangay Clearance', 'Business Permit', 'Certificate of Residency', 'Indigency Certificate'];
    const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const COLORS = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'];
    
    // Document Type Distribution Chart
    const documentData = @json($stats['charts']['documentTypes'] ?? []);
    
    new Chart(document.getElementById('documentChart'), {
        type: 'doughnut',
        data: {
            labels: DOCUMENT_TYPES,
            datasets: [{
                data: DOCUMENT_TYPES.map(type => documentData[type] || 0),
                backgroundColor: COLORS
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endpush

@endsection
