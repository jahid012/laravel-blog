@extends('layouts.app')

@section('page_title', 'Update Pricing package')

@section('page')

    {{-- Page body --}}
    <form method="POST" action="{{ route('admin.prices.update', $price->id) }}">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h1>{{__("Update Pricing package")}}</h1>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">{{ __('Icon Class') }}</label>
                            <input name="icon" value="{{ old('icon', $price->icon) }}"
                                class="form-control @error('icon') is-invalid @enderror" required>
                            @error('icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Package Name') }}</label>
                            <input name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $price->name) }}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Price') }}</label>
                            <input name="price" value="{{ old('price', $price->price) }}"
                                class="form-control @error('price') is-invalid @enderror">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Package Info') }}</label>
                            <textarea name="info" class="form-control @error('info') is-invalid @enderror">{{ old('info', $price->info) }}</textarea>
                            @error('info')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Buy now link') }}</label>
                            <input name="link" value="{{ old('link', $price->link) }}"
                                class="form-control @error('link') is-invalid @enderror">
                            @error('link')
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
