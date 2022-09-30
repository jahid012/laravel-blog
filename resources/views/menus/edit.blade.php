@extends('layouts.app')

@section('page_title', __('Menus List'))

@section('page')
    <form method="post" action="{{ route('menus.update', $menu->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Menus Edit') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group @error('title') has-error @enderror">
                            <label>{{ __('Name') }}</label>
                            <input name="name" value="{{ old('name', $menu->name) }}" class="form-control">
                            @error('name')
                            <small class="">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
