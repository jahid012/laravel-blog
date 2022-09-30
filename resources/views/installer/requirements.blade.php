@extends('layouts.installer')

@section('title', trans('installer_messages.requirements.title'))

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

    <h1 class="h3 text-center">{{ trans('installer_messages.requirements.templateTitle') }}</h1>

    <ul class="list-group">
        @foreach ($data['requirements'] as $extention => $enabled)
            <li class="list-group-item d-flex justify-content-between align-items-center bg-light bg-gradient my-1 py-0 {{ $enabled ? 'success' : 'error' }}">
                {{ $extention }}
                <span class="fs-2">
                    @if ($enabled)
                    <i class="text-success far fa-check-circle"></i>
                    @else
                    <i class="text-danger far fa-times-circle"></i>
                    @endif
                </span>
            </li>
        @endforeach
    </ul>

    @if (true)
        <div class="d-block text-end mt-3">
            <a href="{{ route('install.databaseInfo') }}" class="btn btn-success">
                {{ trans('installer_messages.requirements.next') }}
            </a>
        </div>
    @endif

@endsection
