@extends('admin.dashboard')

<title>Admin: Document Requests Management</title>
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
        margin: 0; /* Remove default margin */
        border-collapse: collapse; /* Ensure borders are properly aligned */
    }

    .table th, .table td {
        padding: 12px;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap; /* Prevents text wrapping */
    }

    .table th.title, .table td.title {
        white-space: normal; /* Allows text wrapping */
        max-width: 200px; /* Set a max-width for the title column */
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

    /* Button Styling */
    .btn {
        border-radius: 5px;
        font-weight: 500;
        color: white;
    }

    .btn-primary {
        background-color: #11468F; /* Matches the blue button in the image */
        border-color: #11468F;
    }

    .btn-primary:hover {
        background-color: #0D3A73;
    }

    .btn-warning {
        background-color: #ffc107; /* Default warning color */
        border-color: #ffc107;
        color: black;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #bd2130;
    }

    /* Badges */
    .badge {
        padding: 5px 10px;
        font-size: 0.85rem;
    }

    h1 {
        font-size: 3rem; /* Increased font size */
        font-weight: bold;
    }

    /* Make the Add News Button Bigger */
    .btn-lg {
        font-size: 1.2rem;
        font-weight: bold;
    }

    /* Buttons Styling */
    .btn-md {
        font-size: 1rem;
        padding: 10px 20px;
    }

    /* Align Add News Button to the Right */
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Search Container */
    .search-container {
        display: flex;
        align-items: center;
        position: relative;
        width: 50%;
    }

    .search-input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 8px 0 0 8px; /* Rounded corners for the left side */
        font-size: 16px;
        outline: none;
    }

    .search-input:focus {
        border-color: #007bff;
    }

    .search-button {
        background: none;
        border: 1px solid #ccc;
        border-left: none;
        border-radius: 0 8px 8px 0; /* Rounded corners for the right side */
        padding: 10px;
        cursor: pointer;
        color: gray;
        outline: none;
    }

    .search-button:hover {
        color: black;
        border-color: #007bff;
    }

    /* Stacked Buttons in Action Column */
    .btn-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 10px; /* Add spacing between buttons */
    }

    .btn-group-vertical .btn {
        width: 100%;
    }

    /* Modal Styles */
    .modal {
        display: none; /* Ensure the modal is hidden on page load */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
        justify-content: center;
        align-items: center;
    }

    /* Modal Content */
    .modal-content {
        background: white; /* ✅ Set modal background to white */
        padding: 20px;
        border-radius: 8px; /* ✅ Rounded corners */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* ✅ Subtle shadow */
        width: 90%;
        max-width: 400px; /* ✅ Restrict max width */
        text-align: center;
    }

    /* Modal Buttons */
    .modal-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }
</style>

@section('content')
<div class="header-container mb-4">
  <h1 class="fw-bold" style="font-size: 3rem; font-weight: bold;">Document Requests Management</h1>
    </div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.document-requests.index') }}" class="search-form">
            <div class="d-flex flex-column flex-md-row gap-4">
                <div class="flex-grow-1">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" class="form-control search-input" 
                               placeholder="Search by Reference No., Name, or Document Type..." 
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Ref No.</th>
                    <th class="p-3 border">Name</th>
                    <th class="p-3 border">Document Type</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documentRequests as $request)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $request->reference_number }}</td>
                    <td class="p-3 border">{{ $request->first_name }} {{ $request->last_name }}</td>
                    <td class="p-3 border">{{ ucwords(str_replace('_', ' ', $request->document_type)) }}</td>
                    <td class="p-3 border">
                        <form action="{{ route('admin.document-requests.update', $request->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="px-2 py-1 border rounded text-sm">
                                <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="released" {{ $request->status == 'released' ? 'selected' : '' }}>Released</option>
                            </select>
                            <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded text-sm">Update</button>
                        </form>
                    </td>
                    <td class="p-3 border flex gap-2">
                        <a href="{{ route('admin.document-requests.show', $request->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.document-requests.edit', $request->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.document-requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">No document requests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

