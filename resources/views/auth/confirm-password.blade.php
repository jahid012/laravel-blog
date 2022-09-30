@extends('layouts.auth')

@section('page_title', __('Login'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </h4>
    <form action="{{ route('password.confirm') }}" method="POST">
        @csrf

        <div class="form-group">
            <label><strong>@lang("Password")</strong></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            @error('password')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm') }}</button>
        </div>
    </form>
</div>
@endsection
