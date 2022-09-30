@extends('layouts.app')

@section('page_title', __('Change my information'))

@section('page')

    <div class="row">
        <div class="col">
            <div class="row">
                <form class="col-sm-12 pb-3" action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @lang('Basic Information')
                        </div>
                        <div class="card-body">

                            <div class="form-row">
                                @csrf
                                <div class="mb-3 col-md-6">
                                    <label>@lang('Email')</label>
                                    <input name="email" value="{{ old('email', $user->email) }}" type="text"
                                        class="form-control @error('email')is-invalid @enderror"
                                        placeholder="@lang('Email')">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>@lang('Username')</label>
                                    <input name="username" value="{{ old('username', $user->username) }}"
                                        class="form-control @error('username')is-invalid @enderror">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="mb-3 col-md-6">
                                    <label>@lang('Role')</label>
                                    <select name="role_id" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ($user->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>@lang('First Name')</label>
                                    <input name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                        type="text" class="form-control @error('first_name')is-invalid @enderror"
                                        placeholder="@lang('First Name')">
                                    @error('first_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label>@lang('Last Name')</label>
                                    <input name="last_name" value="{{ old('last_name', $user->last_name) }}" type="text"
                                        class="form-control @error('last_name')is-invalid @enderror"
                                        placeholder="@lang('Last Name')">
                                    @error('last_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label>@lang('Date of Birth')</label>
                                    <input name="birthday" value="{{ old('birthday', $user->birthday) }}" type="date"
                                        class="form-control @error('birthday')is-invalid @enderror"
                                        placeholder="@lang('Date of Birth')">
                                    @error('birthday')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label>@lang('Phone')</label>
                                    <input name="phone" value="{{ old('phone', $user->phone) }}" type="text"
                                        class="form-control @error('phone')is-invalid @enderror"
                                        placeholder="@lang('Phone')">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">

                                    <label>@lang('Country')</label>
                                    <select name="country" class="form-control">
                                        @foreach (countries() as $code => $country)
                                            <option value="{{ $code }}" @if (old('country', $user->country) == $code) selected @endif>{{ $country['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label>@lang('Address')</label>
                                    <textarea name="address" class="form-control @error('address')is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-success btn-lg">@lang('Update User')</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form class="col-sm-12 pb-3" action="{{ route('profile.change_password') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @lang('Change Password')
                        </div>
                        <div class="card-body">


                            <div class="mb-3">
                                <label>@lang('Current Password')</label>
                                <input name="current_password" type="password"
                                    class="form-control @error('current_password') is-invalid @enderror">
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label>@lang('New Password')</label>
                                <input name="new_password" type="password"
                                    class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label>@lang('New Confirm Password')</label>
                                <input name="new_confirm_password" type="password"
                                    class="form-control @error('new_confirm_password') is-invalid @enderror">
                                @error('new_confirm_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success btn-lg">@lang('Change Password')</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card" style="height: auto;">
                <div class="card-header">
                    @lang("User Info")
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang("Last Update")
                            <span>{{ $user->updated_at->diffForHumans() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang("Created")
                            <span>{{ $user->created_at->diffForHumans() }}</span>
                        </li>
                        @if ($user->email_verified_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang("Verified at")
                                <span>{{ $user->email_verified_at->diffForHumans() }}</span>
                            </li>
                        @endif

                        @if ($user->last_login_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang("Last Logged In")
                                <span>{{ $user->last_login_at->diffForHumans() }}</span>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
