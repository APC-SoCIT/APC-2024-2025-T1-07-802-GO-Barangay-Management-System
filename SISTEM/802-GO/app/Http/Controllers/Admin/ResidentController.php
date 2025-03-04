<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResidentController extends Controller
{
    // Display all residents
    public function index()
    {
        $residents = User::all();
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
            $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');
            $user->valid_id = $validIdPath;
        }

        // Update user
        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'block_street' => $request->block_street,
            'civil_status' => $request->civil_status,
            'religion' => $request->religion,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.residents.index')->with('success', 'Resident updated successfully.');
    }

    // Delete a resident
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.residents.index')->with('success', 'Resident deleted successfully.');
    }
}