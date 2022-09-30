@extends('layouts.app')

@section('page_title', __('Menus List'))

@section('page')

    <form method="post" action="{{ route('menus.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">{{ __('New Menus') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 @error('title') has-error @enderror">
                            <label>{{ __('Name') }}</label>
                            <input name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <small class="">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
