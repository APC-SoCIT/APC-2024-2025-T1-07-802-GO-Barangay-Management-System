<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageResidentController extends Controller
{
    public function index()
    {
        $user = Resident::User();
        return view('admin.manage-resident.manage-resident-index', compact('manage-resident-index'));
    }

    public function create()
    {
        $civilStatusOptions = Resident::$civilStatusOptions;
        return view('admin.manage-resident.create', compact('civilStatusOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'address' => 'required|string',
            'contact' => 'required|string',
            'household_number' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'gender' => 'required|in:Male,Female',
            'civil_status' => 'required|in:' . implode(',', User::$civilStatusOptions),
            'occupation' => 'required|string',
            'email_address' => 'nullable|email',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'nationality' => 'required|string',
            'religion' => 'nullable|string',
            'voter_status' => 'required|in:Registered,Not Registered',
        ]);

        User::create($validated);

        return redirect()->route('manage-resident.index')->with('success', 'Resident added successfully');
    }

    public function edit(User $user)
    {
        $civilStatusOptions = Resident::$civilStatusOptions;
        return view('admin.manage-resident.edit', compact('resident', 'civilStatusOptions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'address' => 'required|string',
            'contact' => 'required|string',
            'household_number' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'gender' => 'required|in:Male,Female',
            'civil_status' => 'required|in:' . implode(',', User::$civilStatusOptions),
            'occupation' => 'required|string',
            'email_address' => 'nullable|email',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string',
            'nationality' => 'required|string',
            'religion' => 'nullable|string',
            'voter_status' => 'required|in:Registered,Not Registered',
        ]);

        $user->update($validated);

        return redirect()->route('manage-resident.index')->with('success', 'Resident updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('manage-resident.index')->with('success', 'Resident deleted successfully');
    }
}