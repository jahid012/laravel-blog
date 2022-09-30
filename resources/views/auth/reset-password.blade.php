@extends('layouts.auth')

@section('page_title', __('Update Password'))

@section('page')
<div class="auth-form">
    <h4 class="text-center mb-4">@lang('Update Password')</h4>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label><strong>@lang('Email')</strong></label>
            <input name="email" value="{{ old('email', $request->email) }}" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="email">
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
        <div class="mb-3">
            <label><strong>@lang('Confirm Password')</strong></label>
            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password" required>
            @error('password_confirmation')
            <div class="invalid-feedback">
                {!! $message !!}
            </div>
            @enderror
        </div>

        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary btn-block">@lang('Reset Password')</button>
        </div>
    </form>

</div>
@endsection
