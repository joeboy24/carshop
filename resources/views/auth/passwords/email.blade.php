@extends('auth.sign')

@section('title', 'Reset password')
@section('heading', 'Reset password')
@section('lead', 'We will email a link to the address on your account.')

@section('body')
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        @if (session('status'))
            <p class="sign_ok">{{ session('status') }}</p>
        @endif
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
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            </span>
        </label>
        <button type="submit">Send reset link</button>
    </form>
    <div class="sign_links">
        <a href="{{ route('login') }}">Back to sign in</a>
        <a href="/">Back to the site</a>
    </div>
@endsection
