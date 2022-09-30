@extends('layouts.app')

@section('page_title', __('Manage Permissions'))

@section('page')
    <form action="{{ route('permissions.update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Permissions')</h4>
                    </div>
                    <div class="card-body">
                        @can('dashboard-show')
                            "ok"
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        @foreach ($roles as $role)
                                            <th class="text-center">{{ $role->display_name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>

                                            <td>{{ $permission->display_name ?: $permission->name }}</td>

                                            @foreach ($roles as $role)
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <div class="form-check">
                                                            <input name="roles[{{ $role->id }}][]"
                                                                class="form-check-input" type="checkbox"
                                                                value="{{ $permission->id }}"
                                                                id="rp-{{ $role->id }}-{{ $permission->id }}" @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                                            <label class="form-check-label"
                                                                for="rp-{{ $role->id }}-{{ $permission->id }}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-lg">@lang('Update')</button>
            </div>
        </div>
    </form>
@endsection
