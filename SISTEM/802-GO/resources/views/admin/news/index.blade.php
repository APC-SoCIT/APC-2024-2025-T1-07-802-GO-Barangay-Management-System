@extends('admin.dashboard')
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
        background-color: #11468F; /* Matches the blue button in the image */
        border-color: #11468F;
        color: white;
    }

    .btn-warning:hover {
        background-color: #0D3A73;
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
<div class="container">
    <!-- Page Header -->
    <div class="header-container mb-4">
        <h1 class="fw-bold" style="font-size: 3rem; font-weight: bold;">News Management</h1>
        <a href="{{ route('admin.news.create') }}" class="btn btn-lg btn-primary px-4 py-2">
            <i class="fas fa-plus"></i> Add New News
        </a>
    </div>

    <form method="GET" action="{{ route('admin.news.index') }}" class="mb-3 w-25">
        <div class="search-container">
            <input type="text" name="search" class="form-control search-input" placeholder="Search news..." value="{{ request('search') }}">
            <button type="submit" class="search-button">
                <i class="fas fa-search">Search</i>
            </button>
        </div>
    </form>

    <!-- Table -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered text-center w-100 m-0">
                <thead class="table-light">
                    <tr>
                        <th>News ID</th>
                        <th class="title">Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td class="title">{{ $item->title }}</td>
                            <td>{{ $item->author }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <span class="badge bg-success">Published</span>
                            </td>
                            <td>
                                <div class="btn-group-vertical">
                                    <a href="{{ route('admin.news.show', $item->id) }}" class="btn btn-md btn-primary px-3">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-md btn-warning px-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-md btn-danger px-3" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                                <!-- Hidden form for deletion -->
                                <form id="deleteForm-{{ $item->id }}" action="{{ route('admin.news.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No news found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h2 style="font-size: 1.5rem; font-weight: bold; text-align: center;">Delete Confirmation</h2>
        <p style="text-align: justify; margin-top: 10px;">
            Are you sure you want to delete this news post?
        </p>
        <div class="modal-buttons">
            <button id="cancelDeleteButton" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
            <button id="confirmDeleteButton" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
        </div>
    </div>
</div>

<script>
    // Get elements
    const deleteModal = document.getElementById("deleteModal");
    const cancelDeleteButton = document.getElementById("cancelDeleteButton");
    const confirmDeleteButton = document.getElementById("confirmDeleteButton");
    let deleteFormId = null;

    // Function to show modal and set form ID
    function confirmDelete(formId) {
        deleteFormId = formId;
        deleteModal.style.display = "flex";
    }

    // Close modal on Cancel
    cancelDeleteButton.addEventListener("click", function() {
        deleteModal.style.display = "none";
        deleteFormId = null;
    });

    // Proceed with form submission on Confirm Delete
    confirmDeleteButton.addEventListener("click", function() {
        if (deleteFormId) {
            document.getElementById(`deleteForm-${deleteFormId}`).submit();
        }
        deleteModal.style.display = "none";
    });

    // Close modal when clicking outside of it
    window.addEventListener("click", function(event) {
        if (event.target === deleteModal) {
            deleteModal.style.display = "none";
            deleteFormId = null;
        }
    });
</script>
@endsection