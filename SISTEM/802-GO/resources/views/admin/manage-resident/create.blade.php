@extends('admin.dashboard')

@section('content')
<div class="container max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Add New Resident</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('manage-resident.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="household_number">Household Number</label>
                    <input type="text" class="form-control" id="household_number" name="household_number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="civil_status">Civil Status</label>
                    <select class="form-control" id="civil_status" name="civil_status" required>
                        @foreach($civilStatusOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control" id="occupation" name="occupation" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email_address">Email Address</label>
                <input type="email" class="form-control" id="email_address" name="email_address">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="birth_date">Birth Date</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="birth_place">Birth Place</label>
                    <input type="text" class="form-control" id="birth_place" name="birth_place" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nationality">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="religion">Religion</label>
                    <input type="text" class="form-control" id="religion" name="religion">
                </div>
            </div>
            <div class="form-group">
                <label for="voter_status">Voter Status</label>
                <select class="form-control" id="voter_status" name="voter_status" required>
                    <option value="Registered">Registered</option>
                    <option value="Not Registered">Not Registered</option>
                </select>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Resident
                </button>
            </div>
        </form>
    </div>
</div>
@endsection