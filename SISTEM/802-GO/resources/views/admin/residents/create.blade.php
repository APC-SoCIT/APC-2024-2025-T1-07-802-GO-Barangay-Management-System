@extends('admin.dashboard')

@section('content')
<div class="container">
  @if(session('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
          <strong>Success!</strong>
          <span>{{ session('success') }}</span>
          <button class="close" onclick="this.parentElement.style.display='none'">
              <i class="fas fa-times"></i>
          </button>
      </div>
  @endif
  <div class="mb-3">
      <a href="{{ route('admin.residents.index') }}" class="back-link">
          <i class="fas fa-arrow-left mr-2"></i> Back to Residents
      </a>
  </div>

  <div class="card">
      <div class="card-header">
          <h1 class="card-title">Add New Resident</h1>
          <p class="card-subtitle">Fill out the details below to register a new resident</p>
      </div>

      <div class="card-body">
          <form method="POST" action="{{ route('admin.residents.store') }}" enctype="multipart/form-data">
              @csrf

              <div class="row">
                  <!-- Personal Information -->
                  <div class="col-md-6">
                      <div class="section">
                          <div class="section-header">
                              <i class="fas fa-user section-icon"></i>
                              <h2 class="section-title">Personal Information</h2>
                          </div>
                          
                          <div class="form-group">
                              <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                              <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
                              @error('first_name') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="middle_name" class="form-label">Middle Name</label>
                              <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}">
                              @error('middle_name') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                              <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
                              @error('last_name') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                              <select name="gender" id="gender" class="form-control" required>
                                  <option value="">Select Gender</option>
                                  <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                  <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                  <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                              </select>
                              @error('gender') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="birthdate" class="form-label">Birthdate <span class="text-danger">*</span></label>
                              <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate') }}" required>
                              @error('birthdate') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                              <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}" required>
                              @error('age') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="civil_status" class="form-label">Civil Status <span class="text-danger">*</span></label>
                              <select name="civil_status" id="civil_status" class="form-control" required>
                                  <option value="">Select Status</option>
                                  <option value="single" {{ old('civil_status') == 'single' ? 'selected' : '' }}>Single</option>
                                  <option value="married" {{ old('civil_status') == 'married' ? 'selected' : '' }}>Married</option>
                                  <option value="widowed" {{ old('civil_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                  <option value="divorced" {{ old('civil_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                              </select>
                              @error('civil_status') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="religion" class="form-label">Religion</label>
                              <input type="text" name="religion" id="religion" class="form-control" value="{{ old('religion') }}">
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
                              <label for="block_street" class="form-label">Block/Street <span class="text-danger">*</span></label>
                              <input type="text" name="block_street" id="block_street" class="form-control" value="{{ old('block_street') }}" required>
                              @error('block_street') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="barangay" class="form-label">Barangay</label>
                              <input type="text" name="barangay" id="barangay" class="form-control bg-light" value="Barangay 802" readonly>
                          </div>
                          
                          <div class="form-group">
                              <label for="district" class="form-label">District</label>
                              <input type="text" name="district" id="district" class="form-control bg-light" value="Sta Ana" readonly>
                          </div>
                          
                          <div class="form-group">
                              <label for="city" class="form-label">City</label>
                              <input type="text" name="city" id="city" class="form-control bg-light" value="Manila" readonly>
                          </div>
                          
                          <div class="form-group">
                              <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                              <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                              @error('email') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                              <input type="password" name="password" id="password" class="form-control" required>
                              @error('password') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                          </div>
                          
                          <div class="form-group">
                              <label for="valid_id" class="form-label">Valid ID (jpg, jpeg, png, pdf) <span class="text-danger">*</span></label>
                              <input type="file" name="valid_id" id="valid_id" class="form-control-file" accept=".jpg, .jpeg, .png, .pdf" required>
                              @error('valid_id') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                              
                              <div class="id-preview-container">
                                  <img id="id_preview" class="id-preview hidden" src="#" alt="ID preview">
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
                      Add Resident
                  </button>
              </div>
          </form>
      </div>
  </div>
</div>

<script>
  // ID Image Preview
  document.getElementById('valid_id').addEventListener('change', function (event) {
      const file = event.target.files[0];
      const preview = document.getElementById('id_preview');

      if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function () {
              preview.src = reader.result;
              preview.classList.remove('hidden');
          };
          reader.readAsDataURL(file);
      } else {
          preview.classList.add('hidden');
          preview.src = "#";
      }
  });

  // Calculate age from birthdate
  document.getElementById('birthdate').addEventListener('change', function() {
      const birthdate = new Date(this.value);
      const today = new Date();
      let age = today.getFullYear() - birthdate.getFullYear();
      const monthDiff = today.getMonth() - birthdate.getMonth();
      
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
          age--;
      }
      
      if (age >= 0) {
          document.getElementById('age').value = age;
      }
  });

  // Form validation
  document.querySelector('form').addEventListener('submit', function(event) {
      const requiredFields = this.querySelectorAll('[required]');
      let isValid = true;
      
      requiredFields.forEach(field => {
          if (!field.value.trim()) {
              isValid = false;
              field.classList.add('border-danger');
              
              // Add error message if it doesn't exist
              const errorId = `${field.id}-error`;
              if (!document.getElementById(errorId)) {
                  const errorMsg = document.createElement('p');
                  errorMsg.id = errorId;
                  errorMsg.className = 'text-danger small mt-1';
                  errorMsg.textContent = 'This field is required';
                  field.parentNode.appendChild(errorMsg);
              }
          } else {
              field.classList.remove('border-danger');
              const errorMsg = document.getElementById(`${field.id}-error`);
              if (errorMsg) errorMsg.remove();
          }
      });
      
      if (!isValid) {
          event.preventDefault();
          window.scrollTo(0, 0);
      }
  });
</script>
@endsection

