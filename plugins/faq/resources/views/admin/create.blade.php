@extends('layouts.app')

@section('page_title', __('Create Faq'))

@section('page')

    <form action="{{ route('admin.faqs.store') }}" method="post">
        <div class="row">
            <div class="col">
                <div id="post-type" class="card h-auto mb-3">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Create Faq') }}</h1>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('Ask') }}</label>
                            <input name="ask" class="form-control @error('ask') is-invalid @enderror"
                                value="{{ old('ask') }}">
                            @error('ask')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Answear') }}</label>
                            <textarea name="answer" class="form-control @error('answer') is-invalid @enderror"
                                rows="4">{{ old('answer') }}</textarea>
                            @error('answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 mb-auto">
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Publish') }}
                        </h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> {{ __(' Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
