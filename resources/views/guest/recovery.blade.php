@extends('layouts.header')

@section('content')

<div class="contents">
    <div class="recovery-container">
        <div class="recovery-header">
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="40" height="40" viewBox="0 0 24 24" 
                fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" 
                stroke-linejoin="round" class="feather feather-mail">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 
                    2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 
                    2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            <h2>Account Recovery</h2>
            <p class="instructions">
                Enter your registered email address.  
                If it exists, we’ll send you recovery instructions.
            </p>
        </div>

        {{-- Error message --}}
        @error('email')
            <div class="message error">{{ $message }}</div>
        @enderror

        {{-- Recovery Form --}}
        <form action="{{ url('recovery/email') }}" method="POST" class="recovery-form">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="e.g. johndoe@email.com" 
                    required
                >
            </div>

            <button type="submit" class="submit-btn">Request Recovery</button>
        </form>

    </div>
</div>

{{-- Styles --}}
<style>

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
        max-width: 100%; 
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

    .message.error {
        background: #ffe5e5;
        color: #d9534f;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    
</style>
@endsection
