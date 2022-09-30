@extends('layouts.master')

@section('page_title', __( 'theme.index.upload.title' ) )

@section('breadcrumb')
<div class="col-sm-6 p-md-0">
    <div class="welcome-text">
        <h4>{{ __( 'theme.index.upload.breadcrumb.title' ) }}</h4>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="ml-auto mr-auto">
        <h1 class="h4 text-center">
            {!! __('theme.upload.info_message') !!}
        </h1>
    </div>
    <div class="ml-auto mr-auto">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <form action="{{ route('backend.themes.extract') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row align-items-center">
                            @error('addon')
                            <div class="invalid-feedback">
                                {!! $message !!}
                            </div>
                            @enderror
                        </div>
                        <div class="form-row align-items-center">
                          <div class="col-auto">
                            <input name="addon" type="file" class="form-control mb-2" accept=".zip" required>
                          </div>
                          <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">{{ __('module.upload.buttons.submit') }}</button>
                          </div>
                        </div>

                      </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
