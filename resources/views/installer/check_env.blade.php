@extends('layouts.installer')

@section('title', trans('installer_messages.init.next_title'))

@section('page')
    <div class="text-muted pt-3">
        <h1 class="h3">{!! trans('installer_messages.init.next_status') !!}</h1>
        <hr>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">APP_URL</label>
            <div class="col-sm-9">
                <input type="text" readonly class="form-control-plaintext" value="{{env('APP_URL')}}">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">QUEUE_CONNECTION</label>
            <div class="col-sm-9">
                <input type="text" readonly class="form-control-plaintext" value="{{env('QUEUE_CONNECTION')}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">SESSION_DRIVER</label>
            <div class="col-sm-9">
                <input type="text" readonly class="form-control-plaintext" value="{{env('SESSION_DRIVER')}}">
            </div>
        </div>



        <form action="{{ route('install.init') }}" method="post" class="pt-3">
            @csrf
            <input type="hidden" name="installer_id" value="{{ $uuid }}">
            <button class="btn btn-secondary" href="{{ route('install.requirements') }}">
                {{ trans('installer_messages.welcome.next') }}
            </button>
        </form>

    </div>

@endsection
