@extends('layouts.app')

@section('page_title', __('User Details'))

@section('page')
    <div class="row">
        <div class="col-lg-5 col-xl-4 ">
            <div class="card" style="height: auto;">
                <h6 class="card-header d-flex align-items-center justify-content-between">
                    @lang('Details')
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-link" data-toggle="tooltip"
                        data-placement="top" title="" data-original-title="Edit User">
                        @lang('Edit')
                    </a>
                </h6>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column pt-3">
                        <div>
                            <img class="rounded-circle img-thumbnail img-responsive mb-4" width="130" height="130"
                                src="{{ $user->avatar }}">
                        </div>
                        <h5>{{ $user->getFullName() }}</h5>
                        <a href="mailto:{{ $user->email }}" class="text-muted font-weight-light mb-2">
                            {{ $user->email }}
                        </a>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item">
                            <strong>@lang('Birthday:')</strong>
                            {{ $user->birthday ?: 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Address:')</strong>
                            {{ $user->address ?: 'N/A' }}
                        </li>
                        <li class="list-group-item">
                            <strong>@lang('Last Logged In:')</strong>
                            @if ($user->last_login_at)
                                {{ $user->last_login_at->diffForHumans() }}
                            @else
                                N/A
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-xl-8">
            <div class="card">
                <div class="card-header">
                    @lang('Activities')
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('IP Address')</th>
                                    <th scope="col">@lang('Message')</th>
                                    <th scope="col">@lang('Log Time')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ativities as $ativity)
                                    <tr>
                                        <td>
                                            {{ $ativity->ip_address }}
                                        </td>
                                        <td>
                                            {{ $ativity->description }}
                                        </td>
                                        <td>
                                            {{ $ativity->created_at->diffForHumans() }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {{ $ativities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('footer-admin_asset')

@endpush

@push('head-admin_asset')

@endpush
