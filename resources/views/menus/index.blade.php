@extends('layouts.app')

@section('page_title', __('Menus List'))

@section('page')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Menus List') }}</h1>
                    <a href="{{ route('menus.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Use') }}</th>
                            <th><span>{{ __('Handle') }}</span></th>
                        </thead>
                        <tbody>

                            @foreach ($data as $value)

                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>

                                        <code>
                                            <span>&lcub;&lcub; menu("{{ $value->name }}") &rcub;&rcub;</span>
                                        </code>
                                    </td>
                                    <td>
                                        <a href="{{route('menus.builder', $value->id )}}" class="btn btn-success text-white mr-1"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('menus.edit', $value->id )}}" class="btn btn-info text-white mr-1"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('menus.destroy', $value->id) }}"
                                            class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete User')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this menu?')"
                                            data-confirm-button="@lang('Yes, delete menu!')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
