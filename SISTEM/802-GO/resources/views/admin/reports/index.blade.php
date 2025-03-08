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
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h3 class="card-title mb-0">Resident Demographics</h3>
            </div>
            <div class="card-body">
                <!-- Gender Distribution -->
                <div class="mb-5">
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
                        <div class="progress rounded-pill" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: {{ $malePercentage }}%; background-color: #4e73df;" 
                                aria-valuenow="{{ $malePercentage }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <!-- Female Stats -->
                    <div class="gender-stats mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-venus text-pink mr-2"></i> Female</span>
                            <span>{{ number_format($femaleCount) }} ({{ round($femalePercentage) }}%)</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: {{ $femalePercentage }}%; background-color: #e83e8c;" 
                                aria-valuenow="{{ $femalePercentage }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <!-- Others Stats -->
                    <div class="gender-stats">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-transgender-alt text-purple mr-2"></i> Others</span>
                            <span>{{ number_format($othersCount) }} ({{ round($othersPercentage) }}%)</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: {{ $othersPercentage }}%; background-color: #9b51e0;" 
                                aria-valuenow="{{ $othersPercentage }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Age Groups -->
                <div>
                    <h5 class="text-muted mb-4">Age Groups</h5>
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="age-group-card bg-light p-3 rounded-lg text-center h-100">
                                <div class="age-icon mb-2">
                                    <i class="fas fa-child fa-2x text-primary"></i>
                                </div>
                                <h3 class="text-primary mb-2">{{ number_format($stats['residents']['by_age']['youth']) }}</h3>
                                <div class="age-label">Youth<br>(<18)</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="age-group-card bg-light p-3 rounded-lg text-center h-100">
                                <div class="age-icon mb-2">
                                    <i class="fas fa-user fa-2x text-success"></i>
                                </div>
                                <h3 class="text-success mb-2">{{ number_format($stats['residents']['by_age']['adult']) }}</h3>
                                <div class="age-label">Adults<br>(18-59)</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="age-group-card bg-light p-3 rounded-lg text-center h-100">
                                <div class="age-icon mb-2">
                                    <i class="fas fa-user-plus fa-2x text-info"></i>
                                </div>
                                <h3 class="text-info mb-2">{{ number_format($stats['residents']['by_age']['senior']) }}</h3>
                                <div class="age-label">Seniors<br>(60+)</div>
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

    <!-- Document Type Breakdown -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title mb-0">Document Type Distribution</h3>
            </div>
            <div class="card-body">
                <canvas id="documentChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Service Response Time Trend -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title mb-0">Response Time Trend</h3>
            </div>
            <div class="card-body">
                <canvas id="responseTimeChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Resident Registration Trend -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h3 class="card-title mb-0">Monthly Resident Registrations</h3>
            </div>
            <div class="card-body">
                <canvas id="registrationTrendChart" height="200"></canvas>
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
    animation: progressAnimation 1.5s ease-in-out;
}

@keyframes progressAnimation {
    from { width: 0; }
}

.age-group-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.news-item {
    border-left: 4px solid transparent;
    transition: all 0.2s ease;
}

.news-item:hover {
    border-left-color: #4e73df;
    transform: translateX(5px);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Document Type Distribution Chart
    new Chart(document.getElementById('documentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Barangay Clearance', 'Business Permit', 'Residency Certificate', 'Others'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
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

    // Response Time Trend Chart
    new Chart(document.getElementById('responseTimeChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Average Response Time (hours)',
                data: [4.2, 3.8, 3.5, 3.2, 2.9, 2.5],
                borderColor: '#4e73df',
                tension: 0.3
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

    // Registration Trend Chart
    new Chart(document.getElementById('registrationTrendChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Registrations',
                data: [65, 78, 90, 85, 92, 88],
                backgroundColor: '#1cc88a'
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
