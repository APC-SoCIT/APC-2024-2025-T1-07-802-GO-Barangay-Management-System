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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Render the registration page located in 'resources/views/auth/register.blade.php'
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'], // Required first name
            'middle_name' => ['nullable', 'string', 'max:255'], // Optional middle name
            'last_name' => ['required', 'string', 'max:255'], // Required last name
            'gender' => ['required', 'string', 'in:male,female,other'], // Gender selection
            'age' => ['required', 'integer', 'min:0'], // Valid age (non-negative)
            'birthdate' => ['required', 'date'], // Valid birthdate
            'street' => ['required|string|max:255'], // Valid street
            'city' => ['required|string|max:255'], // Valid city
            'barangay' => ['required|string|max:255'], // Valid State
            'zip_code' => ['required|string|max:10'], // Valid Zip code
            'civil_status' => ['required', 'string', 'in:single,married,widowed,divorced'], // Civil status
            'religion' => ['nullable', 'string', 'max:255'], // Optional religion
            'spouse_name' => ['nullable', 'string', 'max:255'], // Optional spouse name
            'siblings_name' => ['nullable', 'string', 'max:255'], // Optional siblings name
            'children_name' => ['nullable', 'string', 'max:255'], // Optional children name
            'valid_id' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Valid ID (image file)
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class], // Unique email
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Secure password
        ]);

        // Handle file upload for the valid ID and store it in the 'public/valid-ids' directory
        $validIdPath = $request->file('valid_id')->store('valid-ids', 'public');

        // Create a new user record in the database
        $user = User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'birthdate' => $validated['birthdate'],
            'street' => $validated['street'],
            'city' => $validated ['city'],
            'barangay' => $validated['barangay'],
            'zip_code' => $validated['zip_code'],
            'civil_status' => $validated['civil_status'],
            'religion' => $validated['religion'],
            'spouse_name' => $validated['spouse_name'],
            'siblings_name' => $validated['siblings_name'],
            'children_name' => $validated['children_name'],
            'valid_id' => $validIdPath,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password before storing
        ]);

        // Dispatch the Registered event (e.g., for sending welcome emails)
        event(new Registered($user));

        // Log in the user automatically after registration
        Auth::login($user);

        // Redirect the user to the dashboard
        return redirect(route('dashboard'));
    }
}
