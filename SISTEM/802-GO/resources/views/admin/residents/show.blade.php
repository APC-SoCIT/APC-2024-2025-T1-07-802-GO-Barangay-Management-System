@extends('admin.dashboard')

<title>Admin: Resident Details</title>
<link rel="icon" href="{{ asset('logo/802-GO-LOGO.png') }}" type="image/x-icon">

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Resident Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($resident->gender) }}</p>
            <p><strong>Age:</strong> {{ $resident->age }}</p>
            <p><strong>Birthdate:</strong> {{ $resident->birthdate }}</p>
            <p><strong>Address:</strong> {{ $resident->block_street }}, {{ $resident->barangay }}, {{ $resident->district }}, {{ $resident->city }}</p>
            <p><strong>Civil Status:</strong> {{ ucfirst($resident->civil_status) }}</p>
            <p><strong>Religion:</strong> {{ $resident->religion }}</p>
            <p><strong>Valid ID:</strong> <a href="{{ asset($resident->valid_id) }}" target="_blank">View ID</a></p>
        </div>
    </div>

    <a href="{{ route('admin.residents.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
