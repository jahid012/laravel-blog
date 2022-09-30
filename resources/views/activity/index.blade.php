@extends('layouts.app')

@section('page_title', __('Activities'))

@section('page')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('All User Activity Log')}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Message')</th>
                                <th scope="col">@lang('IP Address')</th>
                                <th scope="col">@lang('Device')</th>
                                <th scope="col">@lang('Platform')</th>
                                <th scope="col">@lang('Browser')</th>
                                <th scope="col">@lang('Log Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->user->username }}</td>
                                <td>{{ $value->description }}</td>
                                <td> {{ $value->ip_address }} </td>
                                <td> {{ $value->device }} </td>
                                <td> {{ $value->platform }} </td>
                                <td> {{ $value->browser }} </td>
                                <td> {{ $value->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($data->currentPage() > 1)
            <div class="card-footer">
                <div class="float-end">
                    {{$data->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
