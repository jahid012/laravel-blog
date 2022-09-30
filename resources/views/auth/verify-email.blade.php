@extends('layouts.auth')

@section('page_title', __('Login'))

@section('page')
<div class="auth-form">
    <p>
    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>

    <form method="POST"  class="mb-2" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn btn-link">
            {{ __('Resend Verification Email') }}
        </button>
    </form>

    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block">@lang('Resend Verification Email')</button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="text-center mt-3">
            <p>@lang("Or")<button class="btn btn-link" href="{{ route('register') }}">@lang( 'Log out' )</button></p>
        </div>
    </form>
</div>
@endsection
