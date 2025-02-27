@extends('admin.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Delete Document Request</h1>
    </div>

    <!-- Confirmation Card -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <p class="mb-4 text-lg">Are you sure you want to delete this document request?</p>
        <p class="text-red-500">This action cannot be undone.</p>

        <div class="grid grid-cols-2 gap-4 my-4">
            <div>
                <label class="block font-medium">Reference Number</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->reference_number }}</p>
            </div>
            <div>
                <label class="block font-medium">Applicant Name</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->first_name }} {{ $documentRequest->last_name }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('admin.document-requests.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</a>
            <form action="{{ route('admin.document-requests.destroy', $documentRequest->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Confirm Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
