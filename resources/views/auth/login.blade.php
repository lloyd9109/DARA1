@extends('layouts.search_bar')

@section('content')
    
    <div class="login-wrapper">
        <div class="login-card">
            <h2 class="login-title">Welcome to DARA</h2>
            <p class="login-subtitle">Sign in to continue</p>

            <form method="POST" action="/auth/login" class="login-form">
                @csrf


                <div class="input-group">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="20" height="20" fill="none" 
                        stroke="currentColor" stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input type="text" name="usn_login" value="{{ old('usn') }}" required placeholder="Username">
                </div>


                <div class="input-group">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="20" height="20" fill="none" 
                        stroke="currentColor" stroke-width="2" 
                        stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-lock">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password_hash_login" required placeholder="Password">
                </div>


                <button name="submitlogin" type="submit" class="login-btn">Login</button>


                @if ($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif


                <div class="form-footer">
                    <a href="/auth/recovery">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

@endsection

