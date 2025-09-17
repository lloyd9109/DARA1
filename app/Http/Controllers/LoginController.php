<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Authenticate user
    public function authenticate(Request $request)
    {
        // ✅ Validate input (including role selection)
        $request->validate([
            'usn_login' => 'required',
            'password_hash_login' => 'required',
            'role' => 'required|in:admin,student,teacher',
        ], [
            'usn_login.required' => 'Please enter your username.',
            'password_hash_login.required' => 'Please enter your password.',
            'role.required' => '⚠ Please select your role before logging in.',
            'role.in' => 'Invalid role selected.',
        ]);

        // ✅ Check if user exists
        $user = User::where('usn', $request->usn_login)->first();

        if (!$user) {
            // Username does not exist → only username error
            return back()->withErrors([
                'usn_login' => 'Incorrect username.',
            ])->onlyInput('usn_login');
        }

        // ✅ Verify password
        if (!password_verify($request->password_hash_login, $user->password_hash)) {
            // Username exists but wrong password → only password error
            return back()->withErrors([
                'password_hash_login' => 'Incorrect password.',
            ])->onlyInput('usn_login'); // keep username filled in
        }

        // ✅ Role check (only runs if username + password are correct)
        if ($user->role !== $request->role) {
            return back()->withErrors([
                'role' => 'Selected role does not match your account.',
            ])->onlyInput('role');
        }

        // ✅ Successful login
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Home page
    public function home()
    {
        return view('home'); // resources/views/home.blade.php
    }
}
