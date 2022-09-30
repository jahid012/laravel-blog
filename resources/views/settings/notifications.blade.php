@extends('layouts.app')

@section('page_title', __('Notifications Settings'))

@section('page')
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <ul class="list-group list-group-flush">
                <a href="{{ route('settings.general') }}" class="list-group-item">@lang('General')</a>
                <a href="{{ route('settings.auth') }}" class="list-group-item">@lang('Authentication')</a>
                <a href="{{ route('settings.notifications') }}" class="list-group-item active">@lang('Notifications')</a>
                <a href="{{ route('settings.mail') }}" class="list-group-item">@lang('Mail')</a>
            </ul>
        </div>

        <div class="col-lg-8 col-xl-9">
            <form method="POST" action="{{ route('settings.update') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3>@lang('Notifications')</h3> @lang('Configure Notifications site settings.')
                        </div>
                    </div>

                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="notifications_signup_email" value="0">
                            <input name="notifications_signup_email" value="1" type="checkbox" data-toggle="toggle"
                                data-size="sm" @if (option('notifications_signup_email')) checked @endif>
                            <label class="form-check-label">@lang('Sign-Up Notification')</label>
                            <small class="form-text text-muted">
                                @lang('Send an email to the Administrators when user signs up.')
                            </small>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
