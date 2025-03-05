@extends('admin.dashboard')

@section('content')
<div class="container">
  <div class="mb-3">
      <a href="{{ route('admin.residents.index') }}" class="back-link">
          <i class="fas fa-arrow-left mr-2"></i> Back to Residents
      </a>
  </div>

  <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
          <h1 class="card-title">Resident Details</h1>
          <a href="{{ route('admin.residents.edit', $user->id) }}" class="btn btn-primary">
              <i class="fas fa-edit mr-2"></i> Edit
          </a>
      </div>

      <div class="card-body">
          <div class="row">
              <!-- Personal Information -->
              <div class="col-md-6">
                  <div class="section">
                      <div class="section-header">
                          <i class="fas fa-user section-icon"></i>
                          <h2 class="section-title">Personal Information</h2>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Full Name</p>
                          <p class="info-value">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Gender</p>
                          <p class="info-value">{{ ucfirst($user->gender) }}</p>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Age</p>
                          <p class="info-value">{{ $user->age }}</p>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Birthdate</p>
                          <p class="info-value">{{ $user->birthdate->format('F d, Y') }}</p>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Civil Status</p>
                          <p class="info-value">{{ ucfirst($user->civil_status) }}</p>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Religion</p>
                          <p class="info-value">{{ $user->religion ?? 'Not specified' }}</p>
                      </div>
                  </div>
              </div>
              
              <!-- Address & ID -->
              <div class="col-md-6">
                  <div class="section">
                      <div class="section-header">
                          <i class="fas fa-map-marker-alt section-icon"></i>
                          <h2 class="section-title">Address & Identification</h2>
                      </div>
                      
                      <div class="info-item">
                          <p class="info-label">Complete Address</p>
                          <p class="info-value">{{ $user->block_street }}, {{ $user->barangay }}, {{ $user->district }}, {{ $user->city }}</p>
                      </div>
                  </div>
                  
                  <div class="section mt-4">
                      <h3 class="mb-2">Valid ID</h3>
                      <div class="card bg-light">
                          <div class="card-body d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                  <i class="fas fa-id-card text-primary mr-3" style="font-size: 1.5rem;"></i>
                                  <div>
                                      <p class="font-weight-medium mb-0">Identification Document</p>
                                      <p class="text-secondary small mb-0">Uploaded ID for verification</p>
                                  </div>
                              </div>
                              <a href="{{ asset('storage/' . $user->valid_id) }}" target="_blank" class="btn btn-sm btn-primary">
                                  <i class="fas fa-eye mr-1"></i> View
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

