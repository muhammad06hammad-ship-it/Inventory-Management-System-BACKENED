<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Show the signup form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle signup form submission.
     * New users always get 'staff' role — Admin can upgrade via User Management.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required'],
            'terms'                 => ['accepted'],
        ], [
            'name.required'                  => 'Please enter your full name.',
            'email.required'                 => 'Please enter your email address.',
            'email.unique'                   => 'This email is already registered. Please login.',
            'password.required'              => 'Please choose a password.',
            'password.confirmed'             => 'Password confirmation does not match.',
            'password.min'                   => 'Password must be at least 8 characters.',
            'terms.accepted'                 => 'You must agree to the Terms & Conditions.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'staff', // New signups always get staff role
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Welcome, ' . $user->name . '! Your account has been created with Staff access.');
    }
}
