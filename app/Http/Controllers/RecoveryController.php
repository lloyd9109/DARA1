<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecoveryController extends Controller
{
    /**
     * Step 1: Show form (enter email)
     */
    public function showRecoverForm()
    {
        return view('guest.forgot'); // forgot.blade.php
    }

    /**
     * Step 1: Handle sending OTP
     */
    public function sendRecovery(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $email = $request->email;
        $otp   = rand(100000, 999999); // 6-digit OTP

        // Store OTP in password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $otp, 'created_at' => now()]
        );

        // Send OTP via PHPMailer
        if (! $this->sendOtpMail($email, $otp)) {
            return back()->with('error', 'Failed to send OTP. Please try again.');
        }

        // Save email in session for next steps
        $request->session()->put('recovery_email', $email);

        return redirect()
            ->route('password.verify.form')
            ->with('success', 'OTP sent to your email.');
    }

    /**
     * Step 2: Show OTP form
     */
    public function showVerifyOtpForm(Request $request)
    {
        return view('guest.verify_otp', [
            'email' => $request->session()->get('recovery_email')
        ]);
    }

    /**
     * Step 2: Handle OTP verification
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $email = $request->session()->get('recovery_email');
        if (! $email) {
            return redirect()->route('password.recover')
                ->withErrors(['email' => 'Session expired. Please request a new recovery code.']);
        }

        $record = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $request->otp)
            ->first();

        if (! $record) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Check expiry (15 minutes)
        if (now()->diffInMinutes($record->created_at) > 15) {
            return back()->withErrors(['otp' => 'OTP expired. Please request again.']);
        }

        // OTP is correct → proceed to reset password
        return redirect()
            ->route('password.reset.form')
            ->with('success', 'OTP verified. You may now reset your password.');
    }

    /**
     * Step 3: Show reset password form
     */
    public function showResetForm(Request $request)
    {
        return view('guest.reset_password', [
            'email' => $request->session()->get('recovery_email')
        ]);
    }

    /**
     * Step 3: Handle new password saving
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $email = $request->session()->get('recovery_email');
        if (! $email) {
            return redirect()->route('password.recover')
                ->withErrors(['email' => 'Session expired. Please start over.']);
        }

        // Update user password (use password_hash column)
        DB::table('users')
            ->where('email', $email)
            ->update(['password_hash' => Hash::make($request->password)]);

        // Delete OTP after use
        DB::table('password_resets')
            ->where('email', $email)
            ->delete();

        // Clear session
        $request->session()->forget('recovery_email');

        return redirect()
            ->route('login.page')
            ->with('success', 'Password reset successful. Please login.');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        $email = $request->session()->get('recovery_email');

        if (! $email) {
            return redirect()->route('password.recover')
                ->withErrors(['email' => 'Session expired. Please request a new recovery code.']);
        }

        // Generate new OTP
        $otp = rand(100000, 999999);

        // Store OTP in DB
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $otp, 'created_at' => now()]
        );

        // Send OTP
        $this->sendOtpMail($email, $otp);

        return back()->with('status', 'A new OTP has been sent to your email.');
    }

    /**
     * Helper: Send OTP email
     */
    private function sendOtpMail($email, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "Your OTP code is <b>{$otp}</b>. It will expire in 15 minutes.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
