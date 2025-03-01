@extends('admin.dashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Barangay Residents</h2>
        <a href="{{ route('manage-resident.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Resident
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" 
               id="searchInput" 
               placeholder="Search residents..." 
               class="w-full sm:w-1/3 px-4 py-2 border rounded-lg">
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($residents as $resident)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $resident->full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $resident->age }}</td>
                        <td class="px-6 py-4">{{ $resident->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $resident->contact }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $resident->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $resident->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('manage-resident.edit', $resident) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('manage-resident.destroy', $resident) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Are you sure you want to delete this resident?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No residents found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $residents->links() }}
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        // Add search functionality here
        let searchQuery = e.target.value.toLowerCase();
        let tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchQuery) ? '' : 'none';
        });
    });
</script>
@endsection