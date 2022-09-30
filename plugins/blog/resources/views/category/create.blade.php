@extends('layouts.app')

@section('page_title', __('New Category'))

@section('page')

    <form method="post" action="{{ route('categories.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div id="post-type" class="card h-auto mb-3">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('New Category') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="field-title" class="required">{{ __('Title') }}</label>
                            <input id="field-title" name="name" value="{{ old('name') }}"
                                class="form-control @error('name')  is-invalid @enderror">
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>{{ __('Description') }}</label>
                            <textarea name="description" class="form-control @error('description')  is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
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
