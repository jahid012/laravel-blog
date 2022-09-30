@extends('layouts.auth')

@section('page_title', __('Register'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">@lang('Sign up your account')</h4>
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label><strong>@lang('Username')</strong></label>
            <input name="username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username">
            @error('username')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label><strong>@lang('Email')</strong></label>
            <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="hello@example.com" required>
            @error('email')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label><strong>@lang('Password')</strong></label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block">@lang('Sign up')</button>
        </div>
    </form>
    <div class="new-account mt-3">
        <p>@lang('Already have an account?') <a class="text-primary" href="{{ route('login') }}">@lang('Sign in')</a></p>
    </div>
</div>
@endsection
