@extends('layouts.app')

@section('page_title', __('User List'))

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('User List') }}</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-secondary">Add User</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . $user->username }}"
                                                width="60" class="img-fluid rounded-circle"
                                                alt="{{ $user->username }} Avatar">
                                        </td>
                                        <td>
                                            {{ $user->username ?? 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $user->first_name . ' ' . $user->last_name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if ($user->status == 'active')
                                                <span class="badge badge-success">{{ $user->status }}</span>
                                            @elseif ($user->status == 'banned')
                                                <span class="badge badge-danger">{{ $user->status }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $user->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="d-flex justify-content-around">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-primary mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Show User')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-primary mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Edit User')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if (auth()->id() != $user->id)
                                                <a href="{{ route('users.destroy', $user->id) }}"
                                                    class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Delete User')" data-method="DELETE"
                                                    data-confirm-title="@lang('Please Confirm')"
                                                    data-confirm-text="@lang('Are you sure that you want to delete this user?')"
                                                    data-confirm-button="@lang('Yes, delete him!')">
                                                    <i class="fas fa-times  text-white"></i>
                                                </a>
                                                @else
                                                <button
                                                class="btn btn-danger mr-1"
                                                title="@lang('Current LoggedIn user')" disabled>
                                                <i class="fas fa-times"></i>
                                            </button>
                                                @endif

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($users->currentPage() > 1)
                <div class="card-footer">
                    <div class="float-right">
                        {{ $users->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
