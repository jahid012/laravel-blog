@extends('layouts.installer')

@section('title', trans('installer_messages.migration.title'))

@section('page')

@if($avalableTb)
<div class="alert alert-danger text-black" role="alert">
    <h4 class="alert-heading">You will lose your data!</h4>
    <p>You have {{ count($avalableTb) }} tables available in your database</p>
    <hr>
    <p class="mb-0">
        After that, if you can proceed, then click on <strong>Run the installation</strong> button
    </p>
</div>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
    {!! $error !!}
    </div>
@endforeach
@endif

<div class="text-muted pt-3">
    <p>{!! trans('installer_messages.migration.body') !!}</p>
</div>

<div class="d-block text-end mt-3">
    <form action="{{ route('install.installation') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">
            {{ trans('installer_messages.migration.next') }}
        </button>
    </form>
</div>
@endsection
