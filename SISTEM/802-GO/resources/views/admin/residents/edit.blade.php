@extends('admin.dashboard')

@section('content')
<div class="container">
  <div class="mb-3">
      <a href="{{ route('admin.residents.index') }}" class="back-link">
          <i class="fas fa-arrow-left mr-2"></i> Back to Residents
      </a>
  </div>

  <div class="card">
      <div class="card-header">
          <h1 class="card-title">Edit Resident</h1>
          <p class="card-subtitle">Update resident information</p>
      </div>

      <div class="card-body">
          <form action="{{ route('admin.residents.update', $user->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row">
                  <!-- Personal Information -->
                  <div class="col-md-6">
                      <div class="section">
                          <div class="section-header">
                              <i class="fas fa-user section-icon"></i>
                              <h2 class="section-title">Personal Information</h2>
                          </div>
                          
                          <div class="form-group">
                              <label for="first_name" class="form-label">First Name</label>
                              <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}" required>
                              @error('first_name') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="middle_name" class="form-label">Middle Name</label>
                              <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $user->middle_name }}">
                              @error('middle_name') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="last_name" class="form-label">Last Name</label>
                              <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}" required>
                              @error('last_name') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="gender" class="form-label">Gender</label>
                              <select name="gender" id="gender" class="form-control" required>
                                  <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                  <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                  <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                              </select>
                              @error('gender') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="age" class="form-label">Age</label>
                              <input type="number" name="age" id="age" class="form-control" value="{{ $user->age }}" required>
                              @error('age') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="birthdate" class="form-label">Birthdate</label>
                              <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $user->birthdate->format('Y-m-d') }}" required>
                              @error('birthdate') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="civil_status" class="form-label">Civil Status</label>
                              <select name="civil_status" id="civil_status" class="form-control" required>
                                  <option value="single" {{ $user->civil_status == 'single' ? 'selected' : '' }}>Single</option>
                                  <option value="married" {{ $user->civil_status == 'married' ? 'selected' : '' }}>Married</option>
                                  <option value="widowed" {{ $user->civil_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                  <option value="divorced" {{ $user->civil_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                              </select>
                              @error('civil_status') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="religion" class="form-label">Religion</label>
                              <input type="text" name="religion" id="religion" class="form-control" value="{{ $user->religion }}">
                              @error('religion') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
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
                          
                          <div class="form-group">
                              <label for="block_street" class="form-label">Block/Street</label>
                              <input type="text" name="block_street" id="block_street" class="form-control" value="{{ $user->block_street }}" required>
                              @error('block_street') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="barangay" class="form-label">Barangay</label>
                              <input type="text" name="barangay" id="barangay" class="form-control bg-light" value="{{ $user->barangay }}" readonly>
                          </div>
                          
                          <div class="form-group">
                              <label for="district" class="form-label">District</label>
                              <input type="text" name="district" id="district" class="form-control bg-light" value="{{ $user->district }}" readonly>
                          </div>
                          
                          <div class="form-group">
                              <label for="city" class="form-label">City</label>
                              <input type="text" name="city" id="city" class="form-control bg-light" value="{{ $user->city }}" readonly>
                          </div>
                          
                          <div class="form-group">
                              <label for="email" class="form-label">Email Address</label>
                              <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                              @error('email') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="password" class="form-label">Password (leave blank to keep current)</label>
                              <input type="password" name="password" id="password" class="form-control">
                              @error('password') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="valid_id" class="form-label">Valid ID</label>
                              <input type="file" name="valid_id" id="valid_id" class="form-control-file">
                              @error('valid_id') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                              
                              <div class="mt-3">
                                  <p class="small text-secondary mb-2">Current ID:</p>
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

              <div class="mt-4 d-flex justify-content-end">
                  <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary mr-2">
                      Cancel
                  </a>
                  <button type="submit" class="btn btn-primary">
                      Update Resident
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection

