@extends('auth.sign')

@section('title', 'Choose a password')
@section('heading', 'Choose a password')
@section('lead', 'Set a new password for this account.')

@section('body')
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        @if (isset($errors) && $errors->any())
            <p class="sign_error">{{ $errors->first() }}</p>
        @endif
        <label class="sign_field">
            <span>Email</span>
            <span class="sign_control">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                    <path d="M3 7l9 7 9-7"></path>
                </svg>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" required autofocus>
            </span>
        </label>
        <label class="sign_field">
            <span>New password</span>
            <span class="sign_control has_reveal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                    <path d="M8 11V8a4 4 0 0 1 8 0v3"></path>
                </svg>
                <input id="password" type="password" name="password" autocomplete="new-password" required>
                <button class="sign_reveal" type="button">Show</button>
            </span>
        </label>
        <label class="sign_field">
            <span>Confirm password</span>
            <span class="sign_control has_reveal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                    <path d="M8 11V8a4 4 0 0 1 8 0v3"></path>
                </svg>
                <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password" required>
                <button class="sign_reveal" type="button">Show</button>
            </span>
        </label>
        <button type="submit">Save password</button>
    </form>
    <div class="sign_links">
        <a href="{{ route('login') }}">Back to sign in</a>
        <a href="/">Back to the site</a>
    </div>
@endsection
