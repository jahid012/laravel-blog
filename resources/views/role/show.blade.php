@extends('layouts.app')

@section('page_title', __('Manage Permissions'))

@section('page')
    <form action="{{ route('permissions.updateByRoleName', $role->id ) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">[{{ $role->display_name?? $role->name }}] @lang('Role, Permissions')</h1>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">

                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>

                                        <td>{{ $permission->display_name ?: $permission->name }}</td>

                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <div class="form-check">
                                                    <input name="permissions[]" class="form-check-input"
                                                        type="checkbox" value="{{ $permission->id }}"
                                                        id="p-{{ $permission->id }}"
                                                        @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                                    <label class="form-check-label" for="p-{{ $permission->id }}"></label>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
