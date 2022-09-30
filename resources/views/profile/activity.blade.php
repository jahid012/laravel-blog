@extends('layouts.app')

@section('page_title', __('Active Session'))

@section('page')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('My Active Session') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Message')</th>
                                    <th scope="col">@lang('IP Address')</th>
                                    <th scope="col">@lang('Device')</th>
                                    <th scope="col">@lang('Platform')</th>
                                    <th scope="col">@lang('Browser')</th>
                                    <th scope="col">@lang('Log Time')</th>
                                    <th scope="col">@lang('Action')</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $value)
                                <tr>
                                    <td> {{ $value->description }} </td>
                                    <td> {{ $value->ip_address }} </td>
                                    <td> {{ $value->device }} </td>
                                    <td> {{ $value->platform }} </td>
                                    <td> {{ $value->browser }} </td>
                                    <td> {{ $value->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('profile.activity.destroy', $value->id ) }}"
                                            class="btn btn-danger mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete Activity')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this Activity?')"
                                            data-confirm-button="@lang('Yes, delete Activity!')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
