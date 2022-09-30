@extends('layouts.app')

@section('page_title', __('My Active Session'))

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
                                    <th>@lang('IP Address')</th>
                                    <th>@lang('Device')</th>
                                    <td>@lang('Platform')</td>
                                    <th>@lang('Browser')</th>
                                    <th>@lang('Last Activity')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $session)
                                <tr>
                                    <td>{{ $session['ip_address'] }} </td>
                                    <td>{{ $session['device'] ?: __('Unknown') }} </td>
                                    <td>{{ $session['platform'] ?: __('Unknown') }}</td>
                                    <td>{{ $session['browser'] ?: __('Unknown') }}</td>
                                    <td>{{ $session['updated_at'] }}</td>
                                    <td>
                                        @if ( auth()->user()->last_activity != $session['last_activity'])
                                        <a href="{{ route('profile.session.destroy', $session["id"] ) }}"
                                            class="btn btn-danger mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete Session')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this session?')"
                                            data-confirm-button="@lang('Yes, delete session!')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        @else
                                        <button class="btn btn-danger mr-1" title="@lang('Current Session')" disabled>
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
