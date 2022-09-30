@extends('layouts.app')

@section('page_title', __('Create a User'))

@section('page')
    <form action="{{ route('users.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('User Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ __('A general user profile information.') }}</p>
                        <div class="basic-form">

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label>@lang('Status')</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="banned">Banned</option>
                                        <option value="unconfirmed">Unconfirmed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>@lang('Role')</label>
                                    <select name="role_id" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>@lang('First Name')</label>
                                    <input name="first_name" value="{{ old('first_name') }}" type="text"
                                        class="form-control @error('first_name')is-invalid @enderror"
                                        placeholder="@lang('First Name')">
                                    @error('first_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>@lang('Last Name')</label>
                                    <input name="last_name" value="{{ old('last_name') }}" type="text"
                                        class="form-control @error('last_name')is-invalid @enderror"
                                        placeholder="@lang('Last Name')">
                                    @error('last_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>@lang('Date of Birth')</label>
                                    <input name="birthday" value="{{ old('birthday') }}" type="date"
                                        class="form-control @error('birthday')is-invalid @enderror"
                                        placeholder="@lang('Date of Birth')">
                                    @error('birthday')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>@lang('Phone')</label>
                                    <input name="phone" value="{{ old('phone') }}" type="text"
                                        class="form-control @error('phone')is-invalid @enderror"
                                        placeholder="@lang('Phone')">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>@lang('Address')</label>
                                    <input name="address" value="{{ old('address') }}" type="text"
                                        class="form-control @error('address')is-invalid @enderror"
                                        placeholder="@lang('Address')">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>@lang('Country')</label>
                                    <select name="country" class="form-control">
                                        @foreach (countries() as $code => $country)
                                            <option value="{{ $code }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Login Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ __('Details used for authenticating with the application.') }}</p>
                        <div class="basic-form">

                            <div class="row g-3">

                                <div class="col-md-6 mb-3">
                                    <label>@lang('Email')</label>
                                    <input name="email" value="{{ old('email') }}" type="text"
                                        class="form-control @error('email')is-invalid @enderror"
                                        placeholder="@lang('Email')">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>@lang('Username')</label>
                                    <input name="username" value="{{ old('username') }}"
                                        class="form-control @error('username')is-invalid @enderror"
                                        placeholder="@lang('(optional)')">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>@lang('Password')</label>
                                    <input name="password" type="password"
                                        class="form-control @error('email')is-invalid @enderror"
                                        placeholder="@lang('Password')">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>@lang('Confirm Password')</label>
                                    <input name="password_confirmation" type="password"
                                        class="form-control @error('email')is-invalid @enderror"
                                        placeholder="@lang('Confirm Password')">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg">@lang('Create User')</button>
            </div>
        </div>
    </form>
@endsection
