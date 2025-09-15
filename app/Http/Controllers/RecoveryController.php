<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RecoveryController extends Controller
{
    public function showRecoverForm()
    {
        return view('auth.recovery');
    }

    public function sendRecoveryEmail()
    {
        return view('auth.recovery_confirmation');
    }

    public function VerifyOTP()
    {
        return view('auth.verify_otp');
    }
    public function ResetPassword()
    {
        return view('auth.reset_password');
    }
    //public function sendRecoveryEmail(Request $request)
    //{
    //    $request->validate([
    //        'email' => 'required|email|exists:users,email',
    //    ]);

    //    $user = User::where('email', $request->email)->first();

        // Example: send recovery email (optional)
        // Mail::to($user->email)->send(new RecoveryMail($user));

        // For now, just return a success message
    //    return back()->with('success', 'Recovery instructions have been sent to your email!');
    //}
}
