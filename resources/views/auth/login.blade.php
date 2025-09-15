@extends('layouts.header')
@vite(['resources/css/guest/login.css', 'resources/js/guest/login.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@section('content')

    <div class="login-wrapper">
        <div class="login-card">
            <h2 class="login-title">Welcome to DARA</h2>
            <p class="login-subtitle"></p>

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                {{-- Username field --}}
                <div class="input-wrapper">
                    <div class="input-group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="20" height="20" fill="none"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="text"
                            name="usn_login"
                            value="{{ old('usn_login') }}"
                            placeholder="Username">
                    </div>
                    @error('usn_login')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password field --}}
                <div class="input-wrapper">
                    <div class="input-group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="20" height="20" fill="none"
                            stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-lock">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input type="password"
                            name="password_hash_login"
                            placeholder="Password">
                    </div>
                    @error('password_hash_login')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- General error --}}
                @if ($errors->has('general'))
                    <div class="general-error">{{ $errors->first('general') }}</div>
                @endif

{{-- Role selection (styled radio buttons as cards) --}}
<div class="input-wrapper role-selection">
    <p class="role-title">Select your role:</p>
    <div class="role-options">
        <label class="role-card">
            <input type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
            <div class="role-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <span>Admin</span>
        </label>
        <label class="role-card">
            <input type="radio" name="role" value="student" {{ old('role') == 'student' ? 'checked' : '' }}>
            <div class="role-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <span>Student</span>
        </label>
        <label class="role-card">
            <input type="radio" name="role" value="teacher" {{ old('role') == 'teacher' ? 'checked' : '' }}>
            <div class="role-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <span>Teacher</span>
        </label>
    </div>
    @error('role')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>

                {{-- Submit button --}}
                <button name="submitlogin" type="submit" class="login-btn">Login</button>

                <div class="form-footer">
                    <a href="/auth/recovery">Forgot Password?</a>
                </div>
            </form>

        </div>
    </div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", () => {
    const usernameInput = document.querySelector("input[name='usn_login']");
    const passwordInput = document.querySelector("input[name='password_hash_login']");

    // Restrict username: only letters allowed
    if (usernameInput) {
        usernameInput.addEventListener("keydown", (e) => {
            // Allow control keys (Backspace, Delete, Tab, Arrow keys)
            if (
                e.key === "Backspace" ||
                e.key === "Delete" ||
                e.key === "Tab" ||
                e.key.startsWith("Arrow")
            ) {
                return;
            }

            // Block numbers, spaces, and special characters
            if (!/^[a-zA-Z]$/.test(e.key)) {
                e.preventDefault();
            }
        });

        // Clean pasted input (remove numbers, spaces, and special chars)
        usernameInput.addEventListener("input", () => {
            usernameInput.value = usernameInput.value.replace(/[^a-zA-Z]/g, "");
        });
    }

    // Restrict password: block spaces only (but allow letters, numbers, special chars)
    if (passwordInput) {
        passwordInput.addEventListener("keydown", (e) => {
            if (e.key === " ") {
                e.preventDefault();
            }
        });

        // Clean pasted input (remove spaces)
        passwordInput.addEventListener("input", () => {
            passwordInput.value = passwordInput.value.replace(/\s/g, "");
        });
    }
});

</script>