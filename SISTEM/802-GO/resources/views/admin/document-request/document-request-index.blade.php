@extends('admin.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Document Requests</h1>
    </div>

    <!-- Search Box -->
    <div class="mb-4 flex justify-between">
        <input type="text" name="search" class="border border-gray-300 rounded-lg px-4 py-2 w-1/3" placeholder="Search by reference number..." value="{{ request('search') }}">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Search</button>
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