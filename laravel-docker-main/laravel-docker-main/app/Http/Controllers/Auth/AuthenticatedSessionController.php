<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Custom login request for validation
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Return the login view, this is where the login form is shown
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate the login request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if the user has exceeded the maximum number of login attempts
        $this->ensureIsNotRateLimited($request);

        // Check if the provided credentials are correct
        if (!Auth::attempt($request->only('email', 'password'))) {
            // Increment the login attempts for the user
            RateLimiter::hit($this->throttleKey($request));

            // If login fails, return to the login page with an error message
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }

        // Clear the login attempts for the user
        RateLimiter::clear($this->throttleKey($request));

        // Redirect to the intended page (dashboard) upon successful login
        return redirect()->intended(route('dashboard'))->with('success', 'Login successful!');
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            throw ValidationException::withMessages([
                'email' => __('auth.throttle', [
                    'seconds' => RateLimiter::availableIn($this->throttleKey($request)),
                ]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function throttleKey(Request $request): string
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Destroy an authenticated session (logout).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout the user using the 'web' guard
        Auth::guard('web')->logout();

        // Invalidate the session to ensure no session hijacking can occur
        $request->session()->invalidate();

        // Regenerate the session token to further protect against session fixation attacks
        $request->session()->regenerateToken();

        // Redirect the user to the homepage (or a custom route like '/login' if needed)
        return redirect('/');
    }
}
