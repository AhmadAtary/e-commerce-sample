@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="padding: 4rem 2rem; background-color: #393d32; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 400px; width: 100%; background-color: #4a5568; border-radius: 10px; padding: 2rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);">
        <h1 style="text-align: center; color: #d3b979; font-size: 2rem; margin-bottom: 2rem;">Login</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div style="margin-bottom: 1.5rem;">
                <label for="email" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; background-color: #6b7280; color: #fff;">
                @error('email')
                    <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; background-color: #6b7280; color: #fff;">
                @error('password')
                    <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div style="margin-bottom: 1.5rem;">
                <label for="remember_me" style="display: flex; align-items: center; color: #a0aec0;">
                    <input id="remember_me" type="checkbox" name="remember" style="margin-right: 0.5rem;">
                    Remember me
                </label>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #d3b979; text-decoration: none; font-size: 0.9rem;">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" style="background-color: #d3b979; color: #2d3748; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: background-color 0.3s ease;">
                    Log in
                </button>
            </div>
        </form>
        
        <div style="text-align: center; margin-top: 2rem; color: #a0aec0;">
            Don't have an account? <a href="{{ route('register') }}" style="color: #d3b979; text-decoration: none;">Register here</a>
        </div>
    </div>
</div>
@endsection

