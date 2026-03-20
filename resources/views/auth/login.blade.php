@extends('layouts.auth')

@section('title', 'Sign In')
@section('card-title', 'Sign in to your account')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="current-password"
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group form-check">
            <input
                type="checkbox"
                name="remember"
                class="form-check-input"
                id="remember"
                {{ old('remember') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            <i class="fa fa-sign-in mr-1"></i> Sign In
        </button>

        <p class="text-center mt-3 mb-0" style="font-size:0.875rem;">
            Don't have an account?
            <a href="{{ route('register') }}">Register your brand</a>
        </p>
    </form>
@endsection
