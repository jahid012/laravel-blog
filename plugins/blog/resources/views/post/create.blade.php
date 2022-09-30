@extends('layouts.app')

@section('page_title', __('New Post'))

@section('page')

    <form method="post" action="{{ route('posts.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div id="post-type" class="card h-auto mb-3">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('New Post') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="field-title" class="required">{{ __('Title') }}</label>
                            <input id="field-title" name="title" value="{{ old('title') }}"
                                class="form-control @error('title')  is-invalid @enderror">
                            @error('title')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field-slug" class="required">{{ __('Permalink') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-body text-dark">blog/</span>
                                <input id="field-slug" value="{{ old('slug') }}" target-id="field-title" name="slug" class="form-control @error('slug')  is-invalid @enderror">
                            </div>
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3 @error('summary')  is-invalid @enderror">
                            <label>{{ __('summary') }}</label>
                            <textarea name="summary" class="form-control">{{ old('summary') }}</textarea>
                            @error('summary')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="@error('content')  is-invalid @enderror">
                            <label>{{ __('Content') }}</label>
                            <textarea name="content" class="summernote">{{ old('content') }}</textarea>
                            @error('content')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                @include('includes.seo', ['seo' => Seo::find(null) ])
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

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Status') }}
                        </h3>
                        <select class="w-100 form-control mr-sm-2" name="status">
                            <option value="published" selected>Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        @error('status')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Category') }}
                        </h3>
                        <select class="w-100 form-control mr-sm-2" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Image') }}
                        </h3>
                        <div id="post-thumbnail" class="media-picker">
                            <input name="thumbnail" type="hidden" />
                        </div>
                        @error('thumbnail')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection


@push('footer')

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                toolbar: [
                    // [groupName, [list of button]]

                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', false],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['codeview']],
                ],

            });

        });
    </script>
@endpush
