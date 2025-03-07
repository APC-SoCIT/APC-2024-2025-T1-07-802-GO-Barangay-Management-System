<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class ResidentController extends Controller
{
    // Display all residents
    public function index(Request $request)
    {
        $query = User::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('block_street', 'like', "%{$search}%")
                  ->orWhere('barangay', 'like', "%{$search}%");
            });
        }
        
        $residents = $query->paginate(10);
        return view('admin.residents.index', compact('residents'));
    }

    // Show form to create a new resident
    public function create()
    {
        return view('admin.residents.create');
    }

    // Store new resident
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:1',
            'birthdate' => 'required|date',
            'block_street' => 'required|string|max:255',
            'civil_status' => 'required|in:single,married,widowed,divorced',
            'religion' => 'nullable|string|max:255',
            'valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // File validation
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Handle file upload
        if ($request->hasFile('valid_id')) {
            $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');
        }

        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'block_street' => $request->block_street,
            'barangay' => $request->barangay ?? 'Barangay 802',
            'district' => $request->district ?? 'Sta Ana',
            'city' => $request->city ?? 'Manila',
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'valid_id' => $validIdPath ?? null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.residents.index')->with('success', 'Resident added successfully.');
    }

    // Display specific resident details
    public function show(User $user)
    {
        return view('admin.residents.show', compact('user'));
    }

    // Show form to edit a resident
    public function edit(User $user)
    {
        return view('admin.residents.edit', compact('user'));
    }

    // Update resident details
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:1',
            'birthdate' => 'required|date',
            'block_street' => 'required|string|max:255',
            'civil_status' => 'required|in:single,married,widowed,divorced',
            'religion' => 'nullable|string|max:255',
            'valid_id' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        // Handle file upload
        if ($request->hasFile('valid_id')) {
            // Delete old file if it exists
            if ($user->valid_id && Storage::exists('public/' . $user->valid_id)) {
                Storage::delete('public/' . $user->valid_id);
            }
            
            $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');
            $user->valid_id = $validIdPath;
        }

        // Update user data
        $userData = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'block_street' => $request->block_street,
            'barangay' => $request->barangay ?? $user->barangay,
            'district' => $request->district ?? $user->district,
            'city' => $request->city ?? $user->city,
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'email' => $request->email,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Update user
        $user->update($userData);

        return redirect()->route('admin.residents.index')->with('success', 'Resident updated successfully.');
    }

    // Delete a resident
    public function destroy(User $user)
    {
        // Delete the ID file if it exists
        if ($user->valid_id && Storage::exists('public/' . $user->valid_id)) {
            Storage::delete('public/' . $user->valid_id);
        }
        
        $user->delete();
        return redirect()->route('admin.residents.index')->with('success', 'Resident deleted successfully.');
    }
}

