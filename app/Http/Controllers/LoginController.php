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
        $request->validate([
            'usn_login' => 'required|string',
            'password_hash_login' => 'required|string',
        ]);

        $user = User::where('usn', $request->usn_login)->first();

        if ($user && password_verify($request->password_hash_login, $user->password_hash)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'usn_login' => 'Invalid USN or Password..',
        ])->onlyInput('usn_login');
    }

    // Logout user
            public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('landing');
        }

    // Home page
    public function home()
    {
        return view('home'); // resources/views/home.blade.php
    }

    // Role-based dashboards
    public function adminDashboard() { return "Welcome Admin Dashboard!"; }
    public function teacherDashboard() { return "Welcome Teacher Dashboard!"; }
    public function studentDashboard() { return "Welcome Student Dashboard!"; }
}
