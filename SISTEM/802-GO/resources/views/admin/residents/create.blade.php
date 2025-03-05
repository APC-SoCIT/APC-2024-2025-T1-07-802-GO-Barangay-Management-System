@extends('admin.dashboard')

<title>Admin: CreateResident </title>
<link rel="icon" href="{{ asset('logo/802-GO-LOGO.png') }}" type="image/x-icon">

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800">Add New Resident</h2>
        <p class="text-gray-600 text-center mb-6">Fill out the details below to register a new resident.</p>

        <form method="POST" action="{{ route('admin.residents.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Full Name -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="first_name" class="block text-gray-700 font-semibold">First Name <span class="text-red-500">*</span></label>
                    <input id="first_name" type="text" name="first_name" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('first_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="middle_name" class="block text-gray-700 font-semibold">Middle Name</label>
                    <input id="middle_name" type="text" name="middle_name" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    @error('middle_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-gray-700 font-semibold">Last Name <span class="text-red-500">*</span></label>
                    <input id="last_name" type="text" name="last_name" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('last_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Personal Details -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="gender" class="block text-gray-700 font-semibold">Gender <span class="text-red-500">*</span></label>
                    <select id="gender" name="gender" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="birthdate" class="block text-gray-700 font-semibold">Birthdate <span class="text-red-500">*</span></label>
                    <input id="birthdate" type="date" name="birthdate" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('birthdate') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="civil_status" class="block text-gray-700 font-semibold">Civil Status <span class="text-red-500">*</span></label>
                    <select id="civil_status" name="civil_status" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="divorced">Divorced</option>
                    </select>
                    @error('civil_status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Address Details -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="block_street" class="block text-gray-700 font-semibold">Block/Street <span class="text-red-500">*</span></label>
                    <input id="block_street" type="text" name="block_street" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('block_street') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="barangay" class="block text-gray-700 font-semibold">Barangay <span class="text-red-500">*</span></label>
                    <input id="barangay" type="text" name="barangay" value="Barangay 802" readonly class="w-full border-gray-300 bg-gray-100 rounded-lg p-2">
                </div>

                <div>
                    <label for="city" class="block text-gray-700 font-semibold">City <span class="text-red-500">*</span></label>
                    <input id="city" type="text" name="city" value="Manila" readonly class="w-full border-gray-300 bg-gray-100 rounded-lg p-2">
                </div>
            </div>

            <!-- Contact & ID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="email" class="block text-gray-700 font-semibold">Email Address <span class="text-red-500">*</span></label>
                    <input id="email" type="email" name="email" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="valid_id" class="block text-gray-700 font-semibold">Valid ID (jpg or png) <span class="text-red-500">*</span></label>
                    <input id="valid_id" type="file" name="valid_id" accept=".jpg, .jpeg, .png" class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('valid_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Image Preview -->
            <div class="mt-4">
                <img id="id_preview" class="mt-2 max-w-xs rounded-lg hidden" src="#" alt="ID preview">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-6">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">Add Resident</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ID Image Preview
    document.getElementById('valid_id').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('id_preview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function () {
                preview.src = reader.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            preview.src = "#";
        }
    });
</script>
@endsection
