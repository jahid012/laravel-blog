@extends('layouts.installer')

@section('title', trans('installer_messages.permissions.title'))

@section('page')

<div id="step-form-horizontal" class="step-form-horizontal">
    <div role="application" class="wizard clearfix" id="steps-uid-0">
        <div class="steps clearfix">
            <ul role="tablist">
                <li role="tab" class="first current " aria-disabled="false" aria-selected="true">
                    <div class="active">
                        <span class="audible active"></span>
                        <span class="number">1.</span>
                    </div>
                </li>
                <li role="tab" class="disabled" aria-disabled="true">
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


    @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <h1 class="h3 text-center">
        {{ trans('installer_messages.permissions.templateTitle') }}
    </h1>
    <ul class="list-group">
        @foreach ($data['permissions'] as $permission)
            <li class="list-group-item d-flex justify-content-between align-items-center bg-light bg-gradient my-1 py-0 {-- { $enabled ? 'success' : 'error' } --}">

                <div>
                @if($permission['type'] == 'dir')
                <i class="far fa-folder"></i>
                @else
                <i class="far fa-file"></i>
                @endif
                {{ $permission['key'] }}
                </div>
                <span class="fs-2">
                    @if ($permission['error'] == false)
                        <i class="far fa-check-circle text-success"></i>
                        @else
                        <i class="far fa-times-circle text-danger"></i>
                    @endif
                    {{ $permission['target_permission'] }}
                </span>
            </li>
        @endforeach
    </ul>
    @if (true)
        <div class="d-block text-end mt-3">
            <a href="{{ route('install.requirements') }}" class="btn btn-success">
                {{ trans('installer_messages.permissions.next') }}
            </a>
        </div>
    @endif
@endsection
