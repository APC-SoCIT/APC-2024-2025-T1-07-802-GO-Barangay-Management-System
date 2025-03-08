@extends('admin.dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Analytics & Reports</h1>
    <p class="page-description">Overview of barangay statistics and activities</p>
</div>

<div class="row">
    <!-- Residents Statistics Card -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Resident Statistics</h3>
            </div>
            <div class="card-body">
                <p><strong>Total Residents:</strong> {{ $stats['total_residents'] }}</p>
                <hr>
                <h4 class="mb-2">Gender Distribution</h4>
                <p>Male: {{ $stats['residents_by_gender']['male'] }}</p>
                <p>Female: {{ $stats['residents_by_gender']['female'] }}</p>
                <hr>
                <h4 class="mb-2">Age Groups</h4>
                <p>Youth (< 18): {{ $stats['residents_by_age']['youth'] }}</p>
                <p>Adults (18-59): {{ $stats['residents_by_age']['adult'] }}</p>
                <p>Senior Citizens (60+): {{ $stats['residents_by_age']['senior'] }}</p>
            </div>
        </div>
    </div>

    <!-- News Statistics Card -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">News Statistics</h3>
            </div>
            <div class="card-body">
                <p><strong>Total News Posts:</strong> {{ $stats['total_news'] }}</p>
                <hr>
                <h4 class="mb-2">Recent News</h4>
                <ul class="list-unstyled">
                    @foreach($stats['recent_news'] as $news)
                        <li class="mb-2">{{ $news->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
