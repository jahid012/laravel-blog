@extends('layouts.app')

@section('page_title', __('About me'))

@section('page')
    <div class="row">
        <div class="col-lg-5 col-xl-4 ">
            <div class="card" style="height: auto;">
                <h6 class="card-header d-flex align-items-center justify-content-between">
                    @lang('About me')
                    <a href="{{ route('profile.edit') }}" class="btn btn-link" data-toggle="tooltip" data-placement="top"
                        title="" data-original-title="Edit User">
                        @lang('Edit')
                    </a>
                </h6>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column pt-3">
                        <div>
                            <img class="rounded-circle img-thumbnail img-responsive mb-4" width="130" height="130"
                                src="{{ $user->avatar }}">
                        </div>
                        <h5>{{ $user->first_name . ' ' . $user->last_name }}</h5>
                        <a href="mailto:{{ $user->email }}" class="text-muted font-weight-light mb-2">
                            {{ $user->email }}
                        </a>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item">
                            <strong>@lang('Birthday:')</strong>
                            {{ $user->birthday ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Address:')</strong>
                            {{ $user->address ?? 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Last Logged In:')</strong>
                            @if ($user->last_login_at)
                                {{ $user->last_login_at->diffForHumans() }}
                            @else
                                N/A
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-xl-8">
            <div class="card">
                <div class="card-header">
                    @lang("Details Information")
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td>@lang('id')</td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Role')</td>
                                    <td>{{ $user->role->name }}</td>
                                </tr>

                                <tr>
                                    <td>@lang('First Name')</td>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Last Name')</td>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Email')</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Username')</td>
                                    <td>{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Phone')</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Address')</td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Country')</td>
                                    <td>{{ $user->country }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Birthday')</td>
                                    <td>{{ $user->birthday }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Last login')</td>
                                    <td>{{ $user->last_login_at }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Status')</td>
                                    <td>{{ $user->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
