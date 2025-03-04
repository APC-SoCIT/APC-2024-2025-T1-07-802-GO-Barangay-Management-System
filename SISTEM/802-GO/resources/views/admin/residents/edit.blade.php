@extends('admin.dashboard')

<title>Admin: Edit Resident</title>

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Edit Resident</h1>

    <form action="{{ route('admin.residents.update', $resident->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Personal Information -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $resident->first_name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ $resident->middle_name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $resident->last_name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="male" {{ $resident->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $resident->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $resident->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" value="{{ $resident->age }}" required>
                </div>
            </div>

            <!-- Address & ID -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Block/Street</label>
                    <input type="text" name="block_street" class="form-control" value="{{ $resident->block_street }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Valid ID</label>
                    <input type="file" name="valid_id" class="form-control">
                    <p class="mt-2"><a href="{{ asset($resident->valid_id) }}" target="_blank">View Current ID</a></p>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection