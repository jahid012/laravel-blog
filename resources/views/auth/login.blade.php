@extends('layouts.auth')

@section('page_title', __('Login'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">@lang('Sign in your account')</h4>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label><strong>@lang("Email")</strong></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="hello@example.com" name="email" value="{{old('email')}}" required autofocus>
            @error('email')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label><strong>@lang("Password")</strong></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            @error('password')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>

        <div class="form-row d-flex justify-content-between mt-4 mb-2">
            @if (option('auth_rememberMe'))
            <div class="mb-3">
                <div class="custom-control custom-checkbox ml-1">
                        <input name="remember" type="checkbox" class="custom-control-input" id="remember_checkbox">
                        <label class="custom-control-label" for="remember_checkbox">@lang('Remember me')</label>
                    </div>
                </div>
            @endif

            @if (option('auth_forgotPassword'))
            <div class="mb-3">
                <a href="{{ route('password.request') }}">@lang("Forgot Password?")</a>
            </div>
            @endif
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block">@lang('Sign in')</button>
        </div>
    </form>

    @if (!option('auth_disableRegistration'))
    <div class="new-account mt-3">
        <p>@lang("Don't have an account? ")<a class="text-primary" href="{{ route('register') }}">@lang('Sign up')</a></p>
    </div>
    @endif

</div>
@endsection
