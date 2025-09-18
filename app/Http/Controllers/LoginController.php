<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // ✅ Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ✅ Authenticate user
    public function authenticate(Request $request)
    {
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

        // 🔍 Check if user exists
        $user = User::where('usn', $request->usn_login)->first();

        if (!$user) {
            return back()->withErrors([
                'usn_login' => 'Incorrect username.',
            ])->onlyInput('usn_login');
        }

        // 🔍 Verify password
        if (!password_verify($request->password_hash_login, $user->password_hash)) {
            return back()->withErrors([
                'password_hash_login' => 'Incorrect password.',
            ])->onlyInput('usn_login');
        }

        // 🔍 Role check
        if ($user->role !== $request->role) {
            return back()->withErrors([
                'role' => 'Selected role does not match your account.',
            ])->onlyInput('role');
        }

        // ✅ Successful login
        Auth::login($user);
        $request->session()->regenerate();

        // ✅ Redirect by role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('home');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        return redirect()->route('home'); // fallback
    }

    // ✅ Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.page'); // back to login page
    }

    // ✅ Admin Dashboard
    public function adminDashboard()
    {
        return view('admindashboard'); // resources/views/admindashboard.blade.php
    }

    // ✅ Teacher Dashboard
    public function teacherDashboard()
    {
        return view('teacherdashboard'); // resources/views/teacherdashboard.blade.php
    }

    // ✅ Student Dashboard (Home)
    public function home()
    {
        return view('home'); // resources/views/home.blade.php
    }
}
