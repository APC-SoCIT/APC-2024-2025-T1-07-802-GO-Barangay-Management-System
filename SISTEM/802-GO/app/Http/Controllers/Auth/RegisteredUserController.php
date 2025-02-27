<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'middle_name' => ['nullable', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'gender' => ['required', 'in:male,female,other'],
        'age' => ['required', 'integer', 'min:1'],
        'birthdate' => ['required', 'date'],
        'block_street' => ['required', 'string', 'max:255'],
        'barangay' => ['required', 'string'],
        'district' => ['required', 'string'],
        'city' => ['required', 'string'],
        'civil_status' => ['required', 'in:single,married,widowed,divorced'],
        'religion' => ['nullable', 'string', 'max:255'],
        'valid_id' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // 2MB max size
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Ensure file is uploaded
    if ($request->hasFile('valid_id')) {
        // Store file and get its path
        $validIdPath = $request->file('valid_id')->store('valid_ids', 'public');
    } else {
        return back()->withErrors(['valid_id' => 'File upload failed. Please try again.']);
    }

    // Create new user
    $user = User::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'gender' => $request->gender,
        'age' => $request->age,
        'birthdate' => $request->birthdate,
        'block_street' => $request->block_street,
        'barangay' => $request->barangay,
        'district' => $request->district,
        'city' => $request->city,
        'civil_status' => $request->civil_status,
        'religion' => $request->religion,
        'valid_id' => $validIdPath, // Store file path in DB
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Send the welcome email after user creation
    Mail::to($user->email)->send(new WelcomeMail($user));

    return redirect()->route('dashboard')->with('success', 'Registration successful!');
}
}