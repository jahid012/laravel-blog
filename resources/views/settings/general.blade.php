@extends('layouts.app')

@section('page_title', __('General Settings'))

@section('page')
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <ul class="list-group list-group-flush">
                <a href="{{ route('settings.general') }}" class="list-group-item active">@lang('General')</a>
                <a href="{{ route('settings.auth') }}" class="list-group-item">@lang('Authentication')</a>
                <a href="{{ route('settings.notifications') }}" class="list-group-item">@lang('Notifications')</a>
                <a href="{{ route('settings.mail') }}" class="list-group-item">@lang('Mail')</a>
            </ul>
        </div>

        <div class="col-lg-8 col-xl-9">
            <form id="app_settings" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3>@lang('General')</h3> @lang('Configure general site settings.')
                        </div>
                    </div>

                    <div class="card-body">
                        @csrf

                        <div class="mb-3">
                            <label>{{ __('Site Url') }}</label>
                            <input value="{{ env('APP_URL') }}" type="text" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label>{{ __('App Name') }}</label>
                            <input name="app_name" value="{{ option('app_name', env('APP_NAME')) }}" type="text"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('App Description') }}</label>
                            <textarea name="app_description"
                                class="form-control">{{ option('app_description', ' ') }}</textarea>
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <label>{!! __('App Favicon') !!}</label>
                                <input name="app_favicon" type="file" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <img src="{{ option('app_favicon', url('/storage/app/public/upload/default/favicon.ico')) }}"
                                    class="img-thumbnail rounded float-right" alt="">
                            </div>
                        </div>
                        <hr/>
                        <div class="mb-3 row">
                            <div class="col">
                                <label>{!! __('Logo #1 (For top navbar)') !!}</label>
                                <input name="app_logo-abbr" type="file" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <img src="{{ option('app_logo-abbr', url('upload/default/logo.png')) }}"
                                    class="img-thumbnail rounded float-right" alt="">
                            </div>
                        </div>

                        <hr />
                        <div class="mb-3 row">
                            <div class="col">
                                <label>{!! __('Logo #2 (For top navbar)') !!}</label>
                                <input name="app_logo-compact" type="file" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <img src="{{ option('app_logo-compact', admin_asset('upload/default/logo-text.png')) }}"
                                    class="img-thumbnail rounded float-right" alt="">
                            </div>
                        </div>
                        <hr />
                        <div class="mb-3 row">
                            <div class="col">
                                <label>{!! __('Logo #3 (For top navbar)') !!}</label>
                                <input name="app_brand-title" type="file" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <img src="{{ option('app_brand-title', admin_asset('upload/default/logo-text.png')) }}"
                                    class="rounded float-right" alt="">
                            </div>
                        </div>
                        <hr />
                        <div class="mb-3 row">
                            <div class="col">
                                <label>{!! __('Copyright (For buttom footer)') !!}</label>
                                <textarea name="app_copyright" class="form-control">{!! option('app_copyright', "Copyright © <a href='/'>DUCOR</a> 2021") !!}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
