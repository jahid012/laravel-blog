@extends('layouts.app')

@section('page_title', 'Create Skill')

@section('page')

    {{-- Page body --}}
    <form method="POST" action="{{ route('admin.skills.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Create Skill') }}</h1>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">{{ __('Type') }}</label>
                            <select name="type" value="{{ old('type') }}"
                                class="form-control @error('type') is-invalid @enderror" required>
                                <option value="language">Language</option>
                                <option value="professional">Professional</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Name') }}</label>
                            <input name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Percentage') }}</label>
                            <input name="percentage"
                                class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') }}" type="number"/>
                            @error('percentage')
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

