<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecoveryController extends Controller
{
    // 👉 Show the recovery form page
    public function showRecoverForm()
    {
        return view('guest.recovery'); // <-- path to your Blade file
    }

    // 👉 Handle the form and send email
    public function sendRecovery(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $token = bin2hex(random_bytes(16)); // sample token

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "gambaza66@gmail.com";
            $mail->Password = "lryg hftu isgu gewb"; // Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom("gambaza66@gmail.com", "DARA");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Recovery';
            $mail->Body    = "
                <h3>Password Recovery Request</h3>
                <p>Click the link below to reset your password:</p>
                <a href='" . url('/reset-password?token=' . $token) . "'>Reset Password</a>
            ";

            $mail->send();

            return back()->with('success', 'Recovery email sent! Please check your inbox.');
        } catch (Exception $e) {
            return back()->withErrors(['email' => "Mailer Error: {$mail->ErrorInfo}"]);
        }
    }
}
