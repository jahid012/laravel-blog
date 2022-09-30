@component('mail::message')

# @lang('Hello!')

@lang('New user was just registered on :app website.', ['app' => env('app_name')])


@lang('To view the user details just visit the link below.')


@component('mail::button', ['url' => route('users.show', $user)])
    @lang('View User')
@endcomponent


@lang('Regards'),<br>
{{ env('app_name') }}

@endcomponent
