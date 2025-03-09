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
                <form action="{{ route('admin.update-status', $documentRequest->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="px-4 py-2 border rounded-lg w-full" onchange="this.form.submit()">
                        <option value="pending" {{ $documentRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $documentRequest->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $documentRequest->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="released" {{ $documentRequest->status === 'released' ? 'selected' : '' }}>Released</option>
                    </select>
                </form>
            </div>
        </div>

        @php
            function displayField($value) {
                return $value ? $value : '<span class="text-gray-500 italic">Not Applicable</span>';
            }

            function displayFieldWithBox($value) {
                return $value 
                    ? '<p class="px-4 py-2 border rounded-lg">' . $value . '</p>' 
                    : '<p class="px-4 py-2 border rounded-lg bg-gray-200 text-gray-500 italic">Not Applicable</p>';
            }
        @endphp

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Full Name</label>
                {!! displayFieldWithBox($documentRequest->first_name . ' ' . ($documentRequest->middle_name ?? '') . ' ' . $documentRequest->last_name) !!}
            </div>
            <div>
                <label class="block font-medium">Document Type</label>
                {!! displayFieldWithBox(ucwords(str_replace('_', ' ', $documentRequest->document_type))) !!}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Gender</label>
                {!! displayFieldWithBox($documentRequest->gender) !!}
            </div>
            <div>
                <label class="block font-medium">Date of Birth</label>
                {!! displayFieldWithBox($documentRequest->date_of_birth) !!}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Place of Birth</label>
                {!! displayFieldWithBox($documentRequest->place_of_birth) !!}
            </div>
            <div>
                <label class="block font-medium">Citizenship</label>
                {!! displayFieldWithBox($documentRequest->citizenship) !!}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Civil Status</label>
                {!! displayFieldWithBox($documentRequest->civil_status) !!}
            </div>
            <div>
                <label class="block font-medium">Occupation</label>
                {!! displayFieldWithBox($documentRequest->occupation) !!}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Annual Income</label>
                {!! displayFieldWithBox($documentRequest->annual_income) !!}
            </div>
            <div>
                <label class="block font-medium">Length of Stay in Barangay</label>
                {!! displayFieldWithBox($documentRequest->length_of_stay) !!}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Contact Number</label>
                {!! displayFieldWithBox($documentRequest->contact_number) !!}
            </div>
            <div>
                <label class="block font-medium">Purpose of Request</label>
                {!! displayFieldWithBox($documentRequest->purpose_of_request) !!}
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Address</label>
            <p class="px-4 py-2 border rounded-lg">
                {!! displayField($documentRequest->block_street) !!}, 
                Barangay {!! displayField($documentRequest->barangay) !!}, 
                {!! displayField($documentRequest->district) !!}, 
                {!! displayField($documentRequest->city) !!}
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-medium">Business Name</label>
                {!! displayFieldWithBox($documentRequest->business_name) !!}
            </div>
            <div>
                <label class="block font-medium">Nature of Business</label>
                {!! displayFieldWithBox($documentRequest->nature_of_business) !!}
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Tax Identification Number (TIN)</label>
            {!! displayFieldWithBox($documentRequest->tax_identification_number) !!}
        </div>

        <!-- Uploaded Documents -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Uploaded Documents</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    'valid_id' => 'Valid ID', 
                    'proof_of_residency' => 'Proof of Residency', 
                    'recent_photo' => 'Recent Photo', 
                    'signature' => 'Signature', 
                    'proof_of_income' => 'Proof of Income', 
                    'dti_sec_registration' => 'DTI/SEC Business Registration', 
                    'lease_contract' => 'Lease Contract', 
                    'business_permit_application' => 'Business Permit Application', 
                    'valid_id_owner' => 'Valid ID of Business Owner'
                ] as $fileField => $fileLabel)
                    <div>
                        <label class="block font-medium">{{ $fileLabel }}</label>
                        <div class="px-4 py-2 border rounded-lg bg-gray-100">
                            @if(!empty($documentRequest->$fileField))
                                @php
                                    $filePath = asset('storage/' . $documentRequest->$fileField);
                                @endphp
                                <a href="{{ $filePath }}" target="_blank" class="text-blue-500 underline">View File</a>
                            @else
                                <p class="text-gray-500 italic">Not Uploaded</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.document-requests.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Back</a>
        </div>
    </div>
</div>
@endsection
