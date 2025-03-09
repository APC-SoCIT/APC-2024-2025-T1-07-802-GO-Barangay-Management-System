@extends('admin.dashboard')

@section('title', 'Admin: Resident Details')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('admin.residents.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Back to Residents
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Resident Details</h1>
            <a href="{{ route('admin.residents.edit', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors inline-flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Personal Information</h2>
                        </div>
                    </div>
                    
                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Full Name</p>
                                <p class="font-medium">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Gender</p>
                                <p class="font-medium">{{ ucfirst($user->gender) }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Age</p>
                                <p class="font-medium">{{ $user->age }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Birthdate</p>
                                <p class="font-medium">{{ $user->birthdate->format('F d, Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Civil Status</p>
                                <p class="font-medium">{{ ucfirst($user->civil_status) }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Religion</p>
                                <p class="font-medium">{{ $user->religion ?? 'Not specified' }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Email Address</p>
                            <p class="font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Address & ID -->
                <div class="space-y-6">
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-800">Address Information</h2>
                            </div>
                        </div>
                        
                        <div class="p-4 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Block/Street</p>
                                <p class="font-medium">{{ $user->block_street }}</p>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Barangay</p>
                                    <p class="font-medium">{{ $user->barangay }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">District</p>
                                    <p class="font-medium">{{ $user->district }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500 mb-1">City</p>
                                <p class="font-medium">{{ $user->city }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-id-card text-purple-600"></i>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-800">Identification</h2>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-id-card text-blue-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Identification Document</p>
                                        <p class="text-sm text-gray-500">Uploaded ID for verification</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $user->valid_id) }}" target="_blank" class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors inline-flex items-center">
                                    <i class="fas fa-eye mr-1.5"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

