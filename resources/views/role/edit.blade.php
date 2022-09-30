@extends('layouts.app')

@section('page_title', __('Update Role'))

@section('page')
    <form action="{{ route('roles.update', $data->id) }}" method="post">
        @csrf
        @method('put')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Update role') }}</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label>@lang('Name')</label>
                            <input name="name" value="{{ old('name', $data->name) }}" type="text"
                                class="form-control @error('name')is-invalid @enderror"
                                placeholder="@lang('Role Name')">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>@lang('Display Name')</label>
                            <input name="display_name" value="{{ old('display_name', $data->name) }}"
                                class="form-control @error('display_name')is-invalid @enderror"
                                placeholder="@lang('Display Name')">
                            @error('display_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg">@lang('Update Role')</button>
            </div>
        </div>
    </form>
@endsection
