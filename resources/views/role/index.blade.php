@extends('layouts.app')

@section('page_title', __('Role List'))

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Role List') }}</h1>
                    <a href="{{ route('roles.create') }}" class="btn btn-secondary">Create Role</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">{{__("Name")}}</th>
                                    <th scope="col">{{__("Display Name")}}</th>
                                    <th scope="col">{{__("Handle")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $role)
                                    <tr>
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            {{ $role->display_name }}
                                        </td>
                                        <td>
                                            @if ($role->isRemovable())
                                            <span class="d-flex">
                                                <a href="{{ route('roles.show', $role->id) }}"
                                                    class="btn btn-success text-white mx-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Show role')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-primary text-white mx-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Edit role')">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="{{ route('roles.destroy', $role->id) }}"
                                                    class="btn btn-danger text-white mx-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Delete role')" data-method="DELETE"
                                                    data-confirm-title="@lang('Please Confirm')"
                                                    data-confirm-text="@lang('Are you sure that you want to delete this Role?')"
                                                    data-confirm-button="@lang('Yes, delete Role!')">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </span>
                                            @else
                                            <span class="d-flex">
                                                <a href="{{ route('roles.show', $role->id) }}"
                                                    class="btn btn-success text-white mx-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Show role')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button class="btn btn-primary mx-1"
                                                    title="@lang('Primary Role')" disabled>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    class="btn btn-danger mx-1"
                                                    title="@lang('Primary Role')" disabled>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($data->currentPage() > 1)
                <div class="card-footer">
                    <div class="float-right">
                        {{ $data->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
