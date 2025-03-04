@extends('admin.dashboard')

<title>Admin: Resident Management</title>
<link rel="icon" href="{{ asset('logo/802-GO-LOGO.png') }}" type="image/x-icon">

<style>
    /* Container Styling */
    .container {
        max-width: 100%;
        padding: 20px;
    }

    /* Card Styling */
    .card {
        border-radius: 10px;
        border: 1px solid #ddd;
        overflow: hidden;
    }

    .card-body {
        padding: 0 !important;
    }

    /* Table Styling */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .table th.title, .table td.title {
        white-space: normal;
        max-width: 200px;
    }

    .table thead {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Search Box */
    .search-box input {
        width: 250px;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 8px 12px;
    }

    /* Buttons */
    .btn {
        border-radius: 5px;
        font-weight: 500;
        color: white;
    }

    .btn-primary {
        background-color: #11468F;
        border-color: #11468F;
    }

    .btn-primary:hover {
        background-color: #0D3A73;
    }

    .btn-warning {
        background-color: #11468F;
        border-color: #11468F;
        color: white;
    }

    .btn-warning:hover {
        background-color: #0D3A73;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #bd2130;
    }

    /* Align Add Resident Button */
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Search Container */
    .search-container {
        display: flex;
        align-items: center;
        width: 50%;
    }

    .search-input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 8px 0 0 8px;
        font-size: 16px;
    }

    .search-input:focus {
        border-color: #007bff;
    }

    .search-button {
        background: none;
        border: 1px solid #ccc;
        border-left: none;
        border-radius: 0 8px 8px 0;
        padding: 10px;
        cursor: pointer;
        color: gray;
    }

    .search-button:hover {
        color: black;
        border-color: #007bff;
    }

    /* Stacked Buttons */
    .btn-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn-group-vertical .btn {
        width: 100%;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    /* Modal Content */
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 400px;
        text-align: center;
    }

    .action-btn {
        display: inline-block; /* Ensures buttons are side by side */
        padding: 8px 12px; /* Adjust button padding */
        font-size: 14px; /* Make sure text fits */
        white-space: nowrap; /* Prevents text from breaking */
    }

    .actions-container {
        display: flex; /* Uses flexbox to align buttons in a row */
        justify-content: center; /* Centers buttons horizontally */
        gap: 5px; /* Adds spacing between buttons */
    }
</style>

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="header-container mb-4">
        <h1 class="fw-bold" style="font-size: 3rem; font-weight: bold;">Resident Management</h1>
        <a href="{{ route('admin.residents.create') }}" class="btn btn-lg btn-primary px-4 py-2">
            <i class="fas fa-plus"></i> Add New Resident
        </a>
    </div>

    <form method="GET" action="{{ route('admin.residents.index') }}" class="mb-3 w-25">
        <div class="search-container">
            <input type="text" name="search" class="form-control search-input" placeholder="Search residents..." value="{{ request('search') }}">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
    </form>

    <!-- Table -->
    <div class="card">
    <div class="card-body p-0">
        <div style="overflow-x: auto;">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Valid ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($residents as $resident)
                        <tr>
                            <td>{{ $resident->id }}</td>
                            <td>{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}</td>
                            <td>{{ ucfirst($resident->gender) }}</td>
                            <td>{{ $resident->block_street }}, {{ $resident->barangay }}, {{ $resident->district }}, {{ $resident->city }}</td>
                            <td>
                                <a href="{{ asset($resident->valid_id) }}" target="_blank">View ID</a>
                            </td>
                            <td>
                                <div class="actions-container">
                                    <a href="{{ route('admin.residents.show', $resident->id) }}" class="btn btn-sm btn-primary action-btn">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.residents.edit', $resident->id) }}" class="btn btn-sm btn-warning action-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger action-btn" onclick="confirmDelete({{ $resident->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No residents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection