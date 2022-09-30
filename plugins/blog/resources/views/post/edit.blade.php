@extends('layouts.app')

@section('page_title', __('Edit Page'))

@section('page')

    <form method="post" action="{{ route('posts.update', $post->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div id="post-type" class="card h-auto mb-3">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Edit Post') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 @error('title') has-error @enderror">
                            <label>{{ __('Title') }}</label>
                            <input name="title" value="{{ old('title', $post->title ) }}" class="form-control">
                            @error('title')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="field-slug" class="required">{{ __('Permalink') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-body text-dark">blog/</span>
                                <input id="field-slug" value="{{ old('slug', $post->slug) }}" name="slug" class="form-control @error('slug')  is-invalid @enderror">
                            </div>
                            @error('slug')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3 @error('summary') has-error @enderror">
                            <label>{{ __('Summary') }}</label>
                            <textarea name="summary" class="form-control">{{ old('summary', $post->summary) }}</textarea>
                            @error('summary')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="@error('content') has-error @enderror">
                            <label>{{ __('Content') }}</label>
                            <textarea name="content" class="summernote">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                @include('includes.seo', ['seo' => Seo::find($post->seo_id) ])
            </div>
            <div class="col-sm-12 col-md-4 mb-auto">
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Publish') }}
                        </h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> {{ __(' Update') }}
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
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Category') }}
                        </h3>
                        <select class="w-100 form-control mr-sm-2" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"  @if($category->id == $post->category_id )  selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Image') }}
                        </h3>
                        @if($post->featured_image)
                        <div id="post-thumbnail" class="media-picker-repaid">
                            <input name="thumbnail" type="hidden" value="{{$post->featured_image}}">
                            <img src="{{$post->featured_image}}">
                        </div>
                        @else
                        <div id="post-thumbnail" class="media-picker">
                            <input name="thumbnail" type="hidden" />
                        </div>
                        @endif

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
                    ['view', [ 'codeview']],
                ],

            });

            $("#seo-card-body-toggle").on('click', function() {
                $(".seo-card-body").toggle();
            });
        });
    </script>
@endpush
