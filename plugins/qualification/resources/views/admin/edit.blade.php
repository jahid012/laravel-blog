@extends('layouts.app')

@section('page_title', 'Update qualification')

@section('page')

    {{-- Page body --}}
    <form method="POST" action="{{ route('admin.qualifications.update', $qualification->id ) }}">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Update qualification') }}</h1>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">{{ __('Type') }}</label>
                            <select name="type" value="{{ old('type', $qualification->type) }}"
                                class="form-control @error('type') is-invalid @enderror" required>
                                <option value="education"  @if($qualification->type == 'education') selected @endif>Education</option>
                                <option value="experience"  @if($qualification->type == 'experience') selected @endif>Experience</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Icon Class') }}</label>
                            <input name="icon" class="form-control @error('icon') is-invalid @enderror"
                                value="{{ old('icon',$qualification->icon) }}" />
                            @error('icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Name') }}</label>
                            <input name="name" value="{{ old('name',$qualification->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Institute') }}</label>
                            <input name="institute"
                                class="form-control @error('institute') is-invalid @enderror" value="{{ old('institute', $qualification->institute) }}" />
                            @error('institute')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Description') }}</label>
                            <textarea name="description"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description',$qualification->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Start at') }}</label>
                            <input name="start_at" value="{{ old('start_at',$qualification->start_at) }}"
                                class="form-control @error('start_at') is-invalid @enderror" type="date">
                            @error('start_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('End at') }}</label>
                            <input name="end_at" value="{{ old('end_at',$qualification->end_at) }}"
                                class="form-control @error('end_at') is-invalid @enderror " type="date">
                            @error('end_at')
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
