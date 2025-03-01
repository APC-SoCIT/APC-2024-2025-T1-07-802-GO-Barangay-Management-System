@extends('admin.dashboard')

@section('content')
<div class="container max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Resident</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manage-resident.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $user->contact }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="household_number">Household Number</label>
                    <input type="text" class="form-control" id="household_number" name="household_number" value="{{ $user->household_number }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Active" {{ $resident->status === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $resident->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" {{ $user->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $user->gender === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="civil_status">Civil Status</label>
                    <select class="form-control" id="civil_status" name="civil_status" required>
                        @foreach($civilStatusOptions as $option)
                            <option value="{{ $option }}" {{ $user->civil_status === $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control" id="occupation" name="occupation" value="{{ $user->occupation }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email_address">Email Address</label>
                <input type="email" class="form-control" id="email_address" name="email_address" value="{{ $user->email_address }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $user->birth_date->format('Y-m-d') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="birth_place">Birth Place</label>
                    <input type="text" class="form-control" id="birth_place" name="birth_place" value="{{ $user->birth_place }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nationality">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $user->nationality }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="religion">Religion</label>
                    <input type="text" class="form-control" id="religion" name="religion" value="{{ $user->religion }}">
                </div>
            </div>
            <div class="form-group">
                <label for="voter_status">Voter Status</label>
                <select class="form-control" id="voter_status" name="voter_status" required>
                    <option value="Registered" {{ $resident->voter_status === 'Registered' ? 'selected' : '' }}>Registered</option>
                    <option value="Not Registered" {{ $resident->voter_status === 'Not Registered' ? 'selected' : '' }}>Not Registered</option>
                </select>
            </div>
            <div class="flex justify-end mt-6">
                <a href="{{ route('manage-resident.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Resident
                </button>
            </div>
        </form>
    </div>
</div>
@endsection