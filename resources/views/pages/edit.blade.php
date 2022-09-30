@extends('layouts.app')

@section('page_title', __('Edit Page'))

@section('page')

    <form method="post" action="{{ route('pages.update', $page->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div id="post-type" class="card h-auto mb-3">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('Edit Page') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 @error('title') has-error @enderror">
                            <label>{{ __('Title') }}</label>
                            <input name="title" value="{{ old('title', $page->title ) }}" class="form-control">
                            @error('title')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-slug">

                            <div class="mb-1 row slug-edit">
                                <label class="col-sm-2 col-form-label required">{{__("Permalink")}}</label>
                                <div class="col d-inline-flex">
                                  <span class="py-2">
                                      @if ($page->locale == app()->getLocale())
                                      {{url('/')}}/
                                      @else
                                      {{url($page->locale )}}/
                                      @endif
                                  </span>
                                {{-- <div class="py-1 m-0">
                                    <a name="show-slug" href="#" onclick="event.preventDefault();"></a>
                                    <button type="button" class="badge bg-primary">Edit</button>
                                </div> --}}
                                  <div class="input-group mb-1">
                                    <input name="slug" type="text" class="form-control" value="{{ old('title', $page->slug ) }}">
                                    {{-- <button type="button" class="input-group-text">Ok</button> --}}
                                  </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3 @error('summary') has-error @enderror">
                            <label>{{ __('Summary') }}</label>
                            <textarea name="summary" class="form-control">{{ old('summary', $page->summary) }}</textarea>
                            @error('summary')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="@error('content') has-error @enderror">
                            <label>{{ __('Content') }}</label>
                            <textarea name="content" class="summernote">{{ old('content', $page->content) }}</textarea>
                            @error('content')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                @include('includes.seo', ['seo' => Seo::find($page->seo_id) ])

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
                            {{ __('Language') }}
                        </h3>
                        <select class="w-100 form-control mr-sm-2" name="locale">
                            @foreach ($languages as $lk => $lv)
                                <option value="{{ $lk }}"  @if($lk == $page->locale)  selected @endif>{{ $lv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Layouts') }}
                        </h3>
                        <select class="w-100 form-control mr-sm-2" name="layout">
                            @foreach ($layouts as $lk => $lv)
                                <option value="{{ str_replace('theme::layouts.', '', $lk) }}"   @if($lk == $page->layout)  selected @endif>{{ $lv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Image') }}
                        </h3>

                        @if($page->thumbnail)
                        <div id="post-thumbnail" class="media-picker-repaid">
                            <input name="thumbnail" type="hidden" value="{{$page->thumbnail}}">
                            <img src="{{$page->thumbnail}}">
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
                    ['view', ['fullscreen', 'codeview']],
                ],

            });
        });
    </script>
@endpush
