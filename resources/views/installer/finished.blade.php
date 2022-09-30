@extends('layouts.installer')

@section('title', trans('installer_messages.final.title'))

@section('page')
    <div class="text-muted pt-3">
        <h1 class="h3">{{ trans('installer_messages.final.status') }}</h1>
        <hr />
        <p>{{ trans('installer_messages.final.templateTitle') }}</p>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">
                {{ trans('installer_messages.admin.form.admin_email_label') }}
            </label>
            <div class="col-sm-9">
                <input value="{{ $user->email }}" class="form-control-plaintext" disabled>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">
                {{ trans('installer_messages.admin.form.admin_password_label') }}
            </label>
            <div class="col-sm-9">
                <input value="{{ trans('installer_messages.final.chosen_password') }}"
                    class="form-control-plaintext" disabled>
            </div>
        </div>

    </div>

    <div class="d-block mt-3">
        <form action="{{ route('optimize.formInstaller', ['ref' => 'installer']) }}" method="get">
            <button type="submit" class="btn btn-secondary">
                {{ trans('installer_messages.final.next') }}
            </button>
        </form>
    </div>

@endsection
