@extends('auth.sign')

@section('title', 'Sign in')
@section('heading', 'Sign in')
@section('lead', 'Use the phone or email on your account.')

@section('body')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        @if (isset($errors) && $errors->any())
            <p class="sign_error">{{ $errors->first() }}</p>
        @endif
        <label class="sign_field">
            <span>Phone or email</span>
            <span class="sign_control">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="6" y="3" width="12" height="18" rx="2"></rect>
                    <path d="M10 18h4"></path>
                </svg>
                <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
            </span>
        </label>
        <label class="sign_field">
            <span>Password</span>
            <span class="sign_control has_reveal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                    <path d="M8 11V8a4 4 0 0 1 8 0v3"></path>
                </svg>
                <input id="password" type="password" name="password" autocomplete="current-password" required>
                <button class="sign_reveal" type="button">Show</button>
            </span>
        </label>
        <button type="submit">Sign in</button>
    </form>
    <div class="sign_links">
        <a href="{{ route('password.request') }}">Forgot password</a>
        <a href="/">Back to the site</a>
    </div>
@endsection
