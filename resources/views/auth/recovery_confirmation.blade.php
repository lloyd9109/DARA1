@extends('layouts.header')

@section('content')

<div class="recovery-wrapper">
    <div class="recovery-container">
        <div class="recovery-header">
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="40" height="40" viewBox="0 0 24 24" 
                fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" 
                stroke-linejoin="round" class="feather feather-check-circle">
                <path d="M9 11l3 3L22 4"></path>
                <circle cx="12" cy="12" r="10"></circle>
            </svg>
            <h2>Check Your Email</h2>
            <p class="instructions">
                If the email address you entered exists in our records, 
                you’ll receive recovery instructions shortly.
            </p>
        </div>

        <a href="{{ url('login') }}" class="back-btn">Back to Login</a>
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
        color: #28a745; /* green success color */
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

    .back-btn {
        display: inline-block;
        padding: 12px 20px;
        background-color: #0c1c43;
        border-radius: 8px;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .back-btn:hover {
        background-color: #142b66;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
