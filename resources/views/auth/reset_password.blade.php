@extends('layouts.header')

@section('content')

<div class="recovery-wrapper">
    <div class="recovery-container">
        <div class="recovery-header">
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="40" height="40" viewBox="0 0 24 24" 
                fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" 
                stroke-linejoin="round" class="feather feather-shield">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>

            <h2>Reset Password</h2>
            <p class="instructions">
                Create a new password for your account.  
                Make sure it’s strong and secure.
            </p>
        </div>

        {{-- Reset Password Form --}}
        <form action="{{ url('auth/reset-password') }}" method="POST" class="recovery-form">
            @csrf

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Enter new password" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="form-input" 
                    placeholder="Confirm new password" 
                    required
                >
            </div>

            <button type="submit" class="submit-btn">Reset Password</button>
        </form>

        <p class="resend">
            Remembered your password? <a href="{{ url('login') }}">Back to Login</a>
        </p>
    </div>
</div>

{{-- Styles --}}
<style>
    .recovery-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        min-height: 80vh;
    }
    .recovery-container {
        background: #fff;
        padding: 35px;
        border-radius: 15px;
        max-width: 420px;
        width: 100%;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        text-align: center;
        border-top: 5px solid #0c1c43;
        animation: fadeIn 0.5s ease-in-out;
    }

    .recovery-header svg {
        color: #0c1c43;
        margin-bottom: 10px;
    }

    .recovery-container h2 {
        margin-bottom: 8px;
        color: #0c1c43;
        font-size: 1.6rem;
    }

    .instructions {
        font-size: 14px;
        color: #666;
        margin-bottom: 25px;
    }

    .form-group {
        text-align: left;
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #0c1c43;
    }

    .form-input {
        width: 100%;
        box-sizing: border-box; 
        padding: 12px 14px;
        border: 1.5px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        background: #fafafa;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        border-color: #0c1c43;
        outline: none;
        background: #fff;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background-color: #0c1c43;
        border: none;
        border-radius: 8px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #142b66;
    }

    .resend {
        margin-top: 15px;
        font-size: 14px;
    }
    .resend a {
        color: #0c1c43;
        text-decoration: none;
        font-weight: 600;
    }
    .resend a:hover {
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
