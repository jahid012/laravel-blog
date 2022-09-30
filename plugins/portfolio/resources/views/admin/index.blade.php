@extends('layouts.app')

@section('page_title', 'Portfolio List')

@section('page')

    {{-- Page body --}}
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Portfolio List') }}</h3>
                    <a class="btn btn-primary" href="{{ route('admin.portfolios.create') }}">
                        {{ __('Create') }}
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('image') }}</th>
                                <th scope="col">{{ __('title') }}</th>
                                <th scope="col">{{ __('category') }}</th>
                                <th scope="col">{{ __('Handle') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portfolios as $value)
                                <tr>
                                    <th scope="row"> <img src="{{ $value->image }}" alt="" width="100" height="100"></th>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->category }}</td>
                                    <td>
                                        <a href="{{route('admin.portfolios.edit', $value->id )}}" class="btn btn-info text-white mr-1"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('admin.portfolios.destroy', $value->id) }}"
                                            class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete Page')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this portfolio?')"
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
