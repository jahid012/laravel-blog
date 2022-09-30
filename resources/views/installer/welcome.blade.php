@extends('layouts.installer')

@section('title', trans('installer_messages.welcome.title'))

@section('page')
    <div class="text-muted pt-3">
        <h1 class="h3">{{ trans('installer_messages.welcome.status') }}</h1>
        <hr>
        <p><strong>{{ trans('installer_messages.welcome.templateTitle') }}</strong></p>
        <div>{!! trans('installer_messages.welcome.description') !!}</div>

        <a class="btn btn-secondary mt-3" href="{{ route('install.check_env') }}">
            {{ trans('installer_messages.welcome.next') }}
        </a>

    </div>

@endsection
