@extends('layouts.app')

@section('page_title', 'Create testimonial')

@section('page')

    {{-- Page body --}}
    <form method="POST" action="{{ route('admin.testimonials.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Create Testimonial') }}</h1>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">{{ __('Author Name') }}</label>
                            <input name="author_name" class="form-control @error('author_name') is-invalid @enderror"
                                value="{{ old('author_name') }}" />
                            @error('author_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Author Intro') }}</label>
                            <input name="author_intro" value="{{ old('author_intro') }}"
                                class="form-control @error('author_intro') is-invalid @enderror">
                            @error('author_intro')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <h3 class="border-bottom pb-2">
                                {{ __('Author Image') }}
                            </h3>
                            <div id="post-thumbnail" class="media-picker">
                                <input name="author_image" type="hidden" />
                            </div>
                            @error('author_image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Quote') }}</label>
                            <textarea name="quote"
                                class="form-control @error('quote') is-invalid @enderror">{{ old('quote') }}</textarea>
                            @error('quote')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
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

