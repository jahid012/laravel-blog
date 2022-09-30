@extends('layouts.app')

@section('page_title', 'Update portfolio')

@section('page')

    {{-- Page body --}}
    <form method="POST" action="{{ route('admin.portfolios.update', $portfolio->id ) }}">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Update portfolio') }}</h1>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">{{ __('title') }}</label>
                            <input name="title" value="{{ old('title',$portfolio->title) }}"
                                class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Category') }}</label>
                            <input name="category"
                                class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $portfolio->category) }}" />
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Image') }}</label>

                            @if($portfolio->image)
                            <div id="post-thumbnail" class="media-picker-repaid">
                                <input name="image" type="hidden" value="{{$portfolio->image}}">
                                <img src="{{$portfolio->image}}">
                            </div>
                            @else
                            <div id="post-thumbnail" class="media-picker">
                                <input name="image" type="hidden" />
                            </div>
                            @endif

                            @error('image')
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
                                <i class="fas fa-save"></i> {{ __(' Update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>


@endsection


@once
    @push('footer')
        <script>
            // get category
            let category = $("#create-portfolio-form select[name='category']").val();
            manageField(category);

            $("#create-portfolio-form select[name='category']").on('change', function() {
                category = $(this).val();
                manageField(category);
            });

            function manageField(category) {

                var linkField = $("#create-portfolio-form [name='link']").parent();
                var contentField = $("#create-portfolio-form [name='content']").parent();
                var previewField = $("#create-portfolio-form [name='preview_url']").parent();

                switch (category) {
                    case 'photo':
                        $(linkField).hide();
                        $(contentField).hide();
                        $(previewField).hide();
                        break;
                    case 'video':
                        $(linkField).show();
                        $(contentField).hide();
                        $(previewField).hide();
                        break;
                    case 'music':
                        $(linkField).show();
                        $(contentField).hide();
                        $(previewField).hide();
                        break;
                    case 'design':
                        $(linkField).show();
                        $(contentField).show();
                        $(previewField).show();
                        break;
                }
            }
        </script>
    @endpush
@endonce
