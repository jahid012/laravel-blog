@extends('layouts.auth')

@section('page_title', __('Forgot Password'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">@lang('Forgot Password')</h4>
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        @if(session('status'))
        <div class="alert alert-primary" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="mb-3">
            <label><strong>@lang('Email')</strong></label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="hello@example.com" value="{{ old('email') }}" required autofocus>
            @error('email')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-block"> {{ __('Email Password Reset Link') }}</button>
        </div>
    </form>
</div>
@endsection
