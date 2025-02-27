@extends('admin.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Document Request Details</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Reference Number</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->reference_number }}</p>
            </div>
            <div>
                <label class="block font-medium">Status</label>
                <p class="px-4 py-2 border rounded-lg">{{ ucfirst($documentRequest->status) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Full Name</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->first_name }} {{ $documentRequest->middle_name ?? '' }} {{ $documentRequest->last_name }}</p>
            </div>
            <div>
                <label class="block font-medium">Document Type</label>
                <p class="px-4 py-2 border rounded-lg">{{ ucwords(str_replace('_', ' ', $documentRequest->document_type)) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Gender</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->gender }}</p>
            </div>
            <div>
                <label class="block font-medium">Date of Birth</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->date_of_birth }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Contact Number</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->contact_number }}</p>
            </div>
            <div>
                <label class="block font-medium">Purpose of Request</label>
                <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->purpose_of_request }}</p>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Address</label>
            <p class="px-4 py-2 border rounded-lg">{{ $documentRequest->block_street }}, Barangay {{ $documentRequest->barangay }}, {{ $documentRequest->district }}, {{ $documentRequest->city }}</p>
        </div>

        <!-- Display uploaded files -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            @foreach(['valid_id', 'proof_of_residency', 'recent_photo', 'signature', 'proof_of_income', 'dti_sec_registration', 'lease_contract', 'business_permit_application', 'valid_id_owner'] as $fileField)
                @if($documentRequest->$fileField)
                    <div>
                        <label class="block font-medium">{{ ucwords(str_replace('_', ' ', $fileField)) }}</label>
                        <img src="{{ asset('storage/' . $documentRequest->$fileField) }}" alt="{{ $fileField }}" class="w-full h-auto border rounded-lg">
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Display extra fields dynamically -->
        @if(!empty($extraData))
            <div class="mb-4">
                <label class="block font-medium">Additional Details</label>
                <ul class="px-4 py-2 border rounded-lg list-disc list-inside">
                    @foreach($extraData as $key => $value)
                        <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex justify-end">
            <a href="{{ route('admin.document-requests.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Back</a>
        </div>
    </div>
</div>
@endsection