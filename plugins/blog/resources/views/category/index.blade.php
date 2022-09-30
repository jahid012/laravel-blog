@extends('layouts.app')

@section('page_title', __('Category List'))

@section('page')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Category List') }}</h1>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th><span>{{ __('Handle') }}</span></th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                        <span class="d-flex justify-content-start">
                                            <a href="{{ route('categories.edit', $value->id) }}"
                                                class="btn btn-info text-white mr-1"><i class="fas fa-pen"></i></a>
                                            <a href="{{ route('categories.destroy', $value->id) }}"
                                                class="btn btn-danger text-white mr-1" data-toggle="tooltip"
                                                data-placement="top" title="@lang('Delete Page')" data-method="DELETE"
                                                data-confirm-title="@lang('Please Confirm')"
                                                data-confirm-text="@lang('Are you sure that you want to delete this category?')"
                                                data-confirm-button="@lang('Yes, delete !')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
