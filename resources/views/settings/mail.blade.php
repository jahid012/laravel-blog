@extends('layouts.app')

@section('page_title', __('Mail Settings'))

@section('page')
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <ul class="list-group list-group-flush pb-3">
                <a href="{{ route('settings.general') }}" class="list-group-item">@lang('General')</a>
                <a href="{{ route('settings.auth') }}" class="list-group-item">@lang('Authentication')</a>
                <a href="{{ route('settings.notifications') }}" class="list-group-item">@lang('Notifications')</a>
                <a href="{{ route('settings.mail') }}" class="list-group-item active">@lang('Mail')</a>

            </ul>
        </div>

        <div class="col-lg-8 col-xl-9">
            <form id="app_settings" method="POST" action="{{ route('settings.update_mail') }}">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3>@lang('Mail')</h3> @lang('Change incoming and outgoing email handlers, email credentials and
                            more.')
                        </div>
                    </div>

                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <label>{{ __('From Address') }}</label>
                            <input name="env_mail_from_address" value="{{ env('MAIL_FROM_ADDRESS') }}" type="text"
                                class="form-control">
                            <div class="form-text text-muted">
                                @lang('All outgoing application emails will be sent from this email address.')
                            </div>
                        </div>
                        <hr />
                        <div class="mb-3">
                            <label>{{ __('From Name') }}</label>
                            <input name="env_mail_from_name" value="{{ env('MAIL_FROM_NAME') }}" type="text"
                                class="form-control">
                            <div class="form-text text-muted">
                                @lang('All outgoing application emails will be sent using this name.')
                            </div>
                        </div>
                        <hr />

                        <div class="bd-callout bd-callout-warning">
                            <h5>Important!</h5>
                            <p>Your selected mail method must be authorized to send emails using this address and name.</p>
                        </div>

                        <div class="mb-3">
                            <label>{{ __('Outgoing Mail Method') }}</label>
                            <select id="setting_mail_driver" name="env_mail_driver" class="form-control">
                                <option value="smtp" @if (env('MAIL_MAILER') == 'smtp') selected @endif>SMTP</option>
                                <option value="sendmail" @if (env('MAIL_MAILER') == 'sendmail') selected @endif>SendMail</option>
                                <option value="log" @if (env('MAIL_MAILER') == 'log') selected @endif>Log (Email will be saved to error log)</option>
                            </select>
                            <div class="form-text text-muted">
                                @lang('Which method should be used for sending outgoing application emails.')
                            </div>
                        </div>

                        <div setting-tab="mail-smtp">

                            <div class="mb-3">
                                <label>{{ __('SMTP Host') }}</label>
                                <input name="env_mail_host" value="{{ env('MAIL_HOST') }}" type="text"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>{{ __('SMTP Username') }}</label>
                                <input name="env_mail_username" value="{{ env('MAIL_USERNAME') }}" type="text"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>{{ __('SMTP Password') }}</label>
                                <input name="env_mail_password" value="{{ env('MAIL_PASSWORD') }}" type="text"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>{{ __('SMTP Port') }}</label>
                                <input name="env_mail_port" value="{{ env('MAIL_PORT') }}" type="text"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>{{ __('SMTP Encryption') }}</label>
                                <input name="env_mail_encryption" value="{{ env('MAIL_ENCRYPTION') }}" type="text"
                                    class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" id="update-mail-btn" class="btn btn-primary" disabled>{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('head')
    <script>
      const mailSettingPage = true;
    </script>
@endpush
