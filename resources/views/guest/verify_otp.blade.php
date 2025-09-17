@extends('layouts.header')

@section('content')
<div class="container">
    <h2>Verify OTP</h2>
    <form method="POST" action="{{ route('password.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <input type="text" name="otp" placeholder="Enter OTP" maxlength="6" required>
        @error('otp') <p class="error">{{ $message }}</p> @enderror
        <button type="submit">Verify</button>
    </form>
</div>
@endsection
