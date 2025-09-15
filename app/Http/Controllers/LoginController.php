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
    if (empty($request->usn_login) && empty($request->password_hash_login)) {
        return back()->withErrors([
            'general' => 'Input Field must not be Empty',
        ]);
    }

    if (empty($request->usn_login)) {
        return back()->withErrors([
            'usn_login' => 'Username field is required.',
        ]);
    }

    if (empty($request->password_hash_login)) {
        return back()->withErrors([
            'password_hash_login' => 'Password field is required.',
        ]);
    }

    // Check if user exists
    $user = User::where('usn', $request->usn_login)->first();

    if (!$user) {
        return back()->withErrors([
            'usn_login' => 'Username not found.',
        ])->onlyInput('usn_login');
    }

    // Verify password
    if (!password_verify($request->password_hash_login, $user->password_hash)) {
        return back()->withErrors([
            'password_hash_login' => 'Incorrect password.',
        ])->onlyInput('usn_login');
    }

    // Successful login
    Auth::login($user);
    $request->session()->regenerate();
    return redirect()->intended('/home');
}


    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
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