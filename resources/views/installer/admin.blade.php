@extends('layouts.installer')

@section('title', trans('installer_messages.admin.title'))

@section('page')

    <div id="step-form-horizontal" class="step-form-horizontal">
        <div role="application" class="wizard clearfix" id="steps-uid-0">
            <div class="steps clearfix">
                <ul role="tablist">
                    <li role="tab" class="first current next" aria-disabled="false" aria-selected="true">
                        <div class="active">
                            <span class="audible active">current step: </span>
                            <span class="number">1.</span>
                        </div>
                    </li>
                    <li role="tab" class="current next" aria-disabled="true">
                        <div class="active">
                            <span class="number next">2.</span>
                        </div>
                    </li>
                    <li role="tab" class="current next" aria-disabled="true">
                        <div class="active">
                            <span class="number">3.</span>
                        </div>
                    </li>
                    <li role="tab" class="last" aria-disabled="true">
                        <div aria-controls="steps-uid-0-p-3">
                            <span class="number">4.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @error('create_user_account')
        <div class="alert alert-danger" role="alert">
            {!! $message !!}
        </div>
    @enderror

    <h1 class="h3">{!! trans('installer_messages.admin.templateTitle') !!}</h1>
    <p>{!! trans('installer_messages.admin.body') !!}</p>
    <form method="post" action="{{ route('install.admin') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">
                {{ trans('installer_messages.admin.form.admin_name_label') }}
            </label>
            <div class="col-sm-9">
                <input name="username" value="{{ old('username', $user->username ?? '') }}" type="text"
                    class="form-control @error('name') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    {{ trans('installer_messages.admin.form.admin_name_info') }}
                </div>

            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">
                {{ trans('installer_messages.admin.form.admin_email_label') }}
            </label>
            <div class="col-sm-9">
                <input name="email" value="{{ old('email', $user->email ?? '') }}" type="email"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    {{ trans('installer_messages.admin.form.admin_email_info') }}
                </div>

            </div>

        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">
                {{ trans('installer_messages.admin.form.admin_password_label') }}
            </label>
            <div class="col-sm-9">
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    {!! trans('installer_messages.admin.form.admin_password_info') !!}
                </div>

            </div>

        </div>

        <small class="d-block text-end mt-3">
            <button type="submit" href="{{ route('install.requirements') }}" class="btn btn-secondary">
                {{ trans('installer_messages.admin.next') }}
            </button>
        </small>
    </form>
@endsection
