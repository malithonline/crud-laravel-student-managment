@extends('layouts.guest')

@section('title', 'Register')
@section('subtitle', 'Create your admin account')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-6">
    @csrf

    <!-- Name -->
    <div class="form-control">
        <label class="label">
            <span class="label-text font-medium">Full Name</span>
        </label>
        <input type="text" 
               name="name" 
               value="{{ old('name') }}" 
               class="input input-bordered @error('name') input-error @enderror" 
               placeholder="Enter your full name"
               required 
               autofocus>
        @error('name')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="form-control">
        <label class="label">
            <span class="label-text font-medium">Email Address</span>
        </label>
        <input type="email" 
               name="email" 
               value="{{ old('email') }}" 
               class="input input-bordered @error('email') input-error @enderror" 
               placeholder="admin@example.com"
               required>
        @error('email')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-control">
        <label class="label">
            <span class="label-text font-medium">Password</span>
        </label>
        <input type="password" 
               name="password" 
               class="input input-bordered @error('password') input-error @enderror" 
               placeholder="Enter secure password"
               required>
        @error('password')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="form-control">
        <label class="label">
            <span class="label-text font-medium">Confirm Password</span>
        </label>
        <input type="password" 
               name="password_confirmation" 
               class="input input-bordered" 
               placeholder="Confirm your password"
               required>
    </div>

    <!-- Submit and Login Link -->
    <div class="space-y-4">
        <button type="submit" class="btn btn-primary w-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Create Account
        </button>
        
        <div class="text-center">
            <span class="text-sm">Already have an account? </span>
            <a href="{{ route('login') }}" class="link link-primary">Sign in here</a>
        </div>
    </div>
</form>
@endsection
