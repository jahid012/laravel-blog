@extends('layouts.installer')

@section('title', trans('installer_messages.database.title') )

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
                        <span class="number">2.</span>
                    </div>
                </li>
                <li role="tab" class="disabled" aria-disabled="true">
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

@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {!! $error !!}
</div>
@endforeach

<form method="post" id="db_form" action="{{ route('install.databaseInfo') }}">
    @csrf

    <div class="row mb-3">
        <h1 class="h3">{!! trans('installer_messages.database.title') !!}</h1>
        <p>{!! trans('installer_messages.database.templateTitle') !!}</p>
    </div>
    <div class="row mb-3">
        <label for="database_connection" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_connection_label') }}
        </label>

        @csrf

        <div class="col-sm-5">
            <select name="DB_CONNECTION" class="form-select" required>
                <option value="mysql" selected>{{__('mysql')}}</option>
                <option value="sqlite">{{__("sqlite")}}</option>
                {{-- <option value="pgsql">{{__('pgsql')}}</option>
                <option value="sqlsrv">{{__('sqlsrv')}}</option> --}}
            </select>
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_connection_info') }}
        </div>
    </div>

    <div class="row mb-3 hide">
        <label for="database_sqlite_path" class="col-sm-3 col-form-label  ">
            {{ trans('SQLite Database Path') }}
        </label>
        <div class="col-sm-5">
            <input value="database/database.sqlite" id="database_sqlite_path" class="form-control" readonly>
        </div>
        <div class="col-sm-4">
            {{ trans('Path is relative to the application root directory.') }}
        </div>
    </div>


    <div class="row mb-3">
        <label for="DB_HOST" class="col-sm-3 col-form-label  ">
            {{ trans('installer_messages.database.form.db_host_label') }}
        </label>
        <div class="col-sm-5">
            <input name="DB_HOST" value="{{ old('DB_HOST', '127.0.0.1') }}" class="form-control" id="DB_HOST" placeholder="{{ trans('installer_messages.database.form.db_host_placeholder') }}">
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_host_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="DB_PORT" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_port_label') }}
        </label>
        <div class="col-sm-5">
            <input name="DB_PORT" value="{{ old('DB_PORT', '3306' ) }}" class="form-control" id="DB_PORT" placeholder="{{ trans('installer_messages.database.form.db_port_placeholder') }}">
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_port_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="DB_DATABASE" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_name_label') }}
        </label>
        <div class="col-sm-5">
            <input name="DB_DATABASE" value="{{ old('DB_DATABASE') }}" class="form-control" id="DB_DATABASE" placeholder="{{ trans('installer_messages.database.form.db_name_placeholder') }}">
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_name_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="DB_USERNAME" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_username_label') }}
        </label>
        <div class="col-sm-5">
            <input name="DB_USERNAME" value="{{ old('DB_USERNAME') }}" class="form-control" id="DB_USERNAME" placeholder="{{ trans('installer_messages.database.form.db_username_placeholder') }}">
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_username_info') }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="DB_PASSWORD" class="col-sm-3 col-form-label">
            {{ trans('installer_messages.database.form.db_password_label') }}
        </label>
        <div class="col-sm-5">
            <input name="DB_PASSWORD" value="{{ old('DB_PASSWORD') }}" class="form-control" id="DB_PASSWORD" placeholder="{{ trans('installer_messages.database.form.db_password_placeholder') }}">
        </div>
        <div class="col-sm-4">
            {{ trans('installer_messages.database.form.db_password_info') }}
        </div>
    </div>

    <small class="d-block text-end mt-3">
        <button type="submit" time="20" class="btn btn-secondary">
            {{ trans('installer_messages.database.next') }}
        </button>
    </small>
</form>

@endsection
