@extends('layouts.app')

@section('page_title', __('Authentication Settings'))

@section('page')
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <ul class="list-group list-group-flush">
                <a href="{{ route('settings.general') }}" class="list-group-item">@lang('General')</a>
                <a href="{{ route('settings.auth') }}" class="list-group-item active">@lang('Authentication')</a>
                <a href="{{ route('settings.notifications') }}" class="list-group-item">@lang('Notifications')</a>
                <a href="{{ route('settings.mail') }}" class="list-group-item">@lang('Mail')</a>
            </ul>
        </div>

        <div class="col-lg-8 col-xl-9">
            <form method="POST" action="{{ route('settings.update') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3>@lang('Authentication')</h3> @lang('Configure login and Registaion')
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf

                        <div class="mb-3">
                            <input type="hidden" name="auth_disableRegistration" value="0">
                            <input name="auth_disableRegistration" value="1" type="checkbox" data-toggle="toggle"
                                data-size="sm" @if (option('auth_disableRegistration')) checked @endif>
                            <label class="form-check-label">@lang('Disable Registration')</label>
                            <small class="form-text text-muted">
                                @lang('All registration will be disabled.')
                            </small>
                        </div>
                        <hr />

                        <div class="mb-3">
                            <input type="hidden" name="auth_rememberMe" value="0">
                            <input name="auth_rememberMe" value="1" type="checkbox" data-toggle="toggle" data-size="sm" @if (option('auth_rememberMe')) checked @endif>
                            <label class="form-check-label">@lang('Allow "Remember Me"')</label>
                            <small class="form-text text-muted">
                                @lang("Should 'Remember Me' checkbox be displayed on login form?")
                            </small>
                        </div>
                        <hr />
                        <div class="mb-3">
                            <input type="hidden" name="auth_forgotPassword" value="0">
                            <input name="auth_forgotPassword" value="1" type="checkbox" data-toggle="toggle" data-size="sm"
                                @if (option('auth_forgotPassword')) checked @endif>
                            <label class="form-check-label">@lang('Forgot Password')</label>
                            <small class="form-text text-muted">
                                @lang('Enable/Disable forgot password feature.')
                            </small>
                        </div>
                        <hr />
                        <div class="mb-3">
                            <input type="hidden" name="auth_verifyEmail" value="0">
                            <input name="auth_verifyEmail" value="1" type="checkbox" data-toggle="toggle" data-size="sm"
                                @if (option('auth_verifyEmail')) checked @endif>
                            <label class="form-check-label">@lang("Auto Verify account's email?")</label>
                            <small class="form-text text-muted">
                                @lang("Enable email verify flag")
                            </small>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang("Update")</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
