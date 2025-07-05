@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div style="padding: 4rem 2rem; background-color: #393d32; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 400px; width: 100%; background-color: #4a5568; border-radius: 10px; padding: 2rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);">
        <h1 style="text-align: center; color: #d3b979; font-size: 2rem; margin-bottom: 2rem;">Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div style="margin-bottom: 1.5rem;">
                <label for="name" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; background-color: #6b7280; color: #fff;">
                @error('name')
                    <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div style="margin-bottom: 1.5rem;">
                <label for="email" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; background-color: #6b7280; color: #fff;">
                @error('email')
                    <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; background-color: #6b7280; color: #fff;">
                @error('password')
                    <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div style="margin-bottom: 1.5rem;">
                <label for="password_confirmation" style="display: block; color: #fff; margin-bottom: 0.5rem; font-weight: bold;">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" style="width: 100%; padding: 0.75rem; border-radius: 5px; border: none; background-color: #6b7280; color: #fff;">
                @error('password_confirmation')
                    <div style="color: #f56565; font-size: 0.9rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; align-items: center;">
                <a href="{{ route('login') }}" style="color: #d3b979; text-decoration: none; font-size: 0.9rem; margin-right: 1rem;">
                    Already registered?
                </a>

                <button type="submit" style="background-color: #d3b979; color: #2d3748; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: background-color 0.3s ease;">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

