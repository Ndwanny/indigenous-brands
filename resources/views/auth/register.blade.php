@extends('layouts.auth')

@section('title', 'Register')
@section('card-title', 'Register Your Brand')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Full Name --}}
        <div class="form-group">
            <label for="name">Full Name <span class="text-danger">*</span></label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="e.g. Chanda Mwale"
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email Address <span class="text-danger">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="you@example.com"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Phone (optional) --}}
        <div class="form-group">
            <label for="phone">
                Phone Number
                <small class="text-muted">(optional)</small>
            </label>
            <input
                type="tel"
                id="phone"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone') }}"
                autocomplete="tel"
                placeholder="+260 97X XXX XXX"
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="new-password"
                placeholder="Minimum 8 characters"
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                required
                autocomplete="new-password"
                placeholder="Repeat your password"
            >
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <i class="fa fa-user-plus mr-1"></i> Create Account
        </button>

        <p class="text-center mt-3 mb-0" style="font-size:0.875rem;">
            Already have an account?
            <a href="{{ route('login') }}">Sign in</a>
        </p>
    </form>
@endsection
