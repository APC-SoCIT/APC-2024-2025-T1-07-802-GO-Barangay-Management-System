@extends('admin.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Document Request</h1>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.document-requests.update', $documentRequest->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Applicant Details -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium">First Name</label>
                    <input type="text" name="first_name" value="{{ $documentRequest->first_name }}" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block font-medium">Last Name</label>
                    <input type="text" name="last_name" value="{{ $documentRequest->last_name }}" class="w-full px-4 py-2 border rounded-lg">
                </div>
            </div>

            <!-- Document Type -->
            <div class="mb-4">
                <label class="block font-medium">Document Type</label>
                <input type="text" name="document_type" value="{{ ucwords(str_replace('_', ' ', $documentRequest->document_type)) }}" class="w-full px-4 py-2 border rounded-lg" readonly>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-medium">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg">
                    <option value="pending" {{ $documentRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $documentRequest->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $documentRequest->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('admin.document-requests.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
