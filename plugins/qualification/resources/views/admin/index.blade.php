@extends('layouts.app')

@section('page_title', 'Qualification List')

@section('page')

    {{-- Page body --}}
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Qualification List') }}</h3>
                    <a class="btn btn-primary" href="{{ route('admin.qualifications.create') }}">
                        {{ __('Create') }}
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('type') }}</th>
                                <th scope="col">{{ __('name') }}</th>
                                <th scope="col">{{ __('institute') }}</th>
                                <th scope="col">{{ __('Handle') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qualifications as $value)
                                <tr>
                                    <th scope="row">{{ $value->type }}</th>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->institute }}</td>
                                    <td>
                                        <a href="{{route('admin.qualifications.edit', $value->id )}}" class="btn btn-info text-white mr-1"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('admin.qualifications.destroy', $value->id) }}"
                                            class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete Page')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this qualification?')"
                                            data-confirm-button="@lang('Yes, delete !')">
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
