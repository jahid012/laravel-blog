@extends('layouts.app')

@section('page_title', __('Dashboard'))

@section('page')
    <div class="row" id="dashboard">

        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">

                    <div class="d-flex align-items-center  ai-icon">
                        <div class="flex-shrink-0">
                            <span class="rounded-circle mr-3">
                                <i class="fs-1 feather-users"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">@lang('Total Users')</p>
                            <h4 class="mb-0">{{ $numberOfUsers }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="rounded-circle mr-3">
                                <i class="fs-1 feather-user-plus"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">@lang('New Users')</p>
                            <h4 class="mb-0">{{ $numberOfNewUsers }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="rounded-circle mr-3">
                                <i class="fs-1 feather-user-x"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">@lang('Banned Users')</p>
                            <h4 class="mb-0">{{ $numberOfBenUsers }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="rounded-circle mr-3">
                                <i class="fs-1 feather-user"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1">@lang('Unconfirmed Users')</p>
                            <h4 class="mb-0">{{ $numberOfUnconformUsers }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="text-center p-5 overlay-box">
                    <img src="{{ $user->avatar }}" width="100" class="img-fluid rounded-circle border" alt="">
                    <h3 class="mt-3 mb-0 text-white ">{{ $user->getFullName() }}</h3>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="bgl-primary rounded p-3">
                                <h4 class="mb-0">{{ $user->gender ?: '0' }}</h4>
                                <small>Patient Gender</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bgl-primary rounded p-3">
                                <h4 class="mb-0">Age: {{ $user->getAge() }}</h4>
                                <small>Years Old</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer mt-0">
                    <a href="{{ route('profile.index') }}" class="btn btn-primary btn-lg btn-block">View Profile</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('login statistics')</h4>
                </div>
                <div class="card-body">
                    <canvas id="loginByOparationSys"></canvas>
                </div>
            </div>
        </div>



        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Activities</h4>
                    <a href="{{ route('activity.index') }}">@lang('View All')</a>
                </div>
                <div class="card-body">

                    <div id="DZ_W_Todo" class="widget-todo dz-scroll ps ps--active-y" style="height:370px;">
                        <ul class="timeline">
                            @foreach ($myActivities as $activity)
                                <li>
                                    <div class="timeline-badge primary"></div>
                                    <a class="timeline-panel text-muted mb-3 d-flex align-items-center"
                                        href="{{ route('users.show', $activity->user->id) }}">
                                        <img class="rounded-circle" alt="" width="50"
                                            src="{{ $activity->user->avatar }}">
                                        <div class="col">
                                            <h5 class="mb-1">{{ $activity->user->getFullName() }}</h5>
                                            <small class="d-block">{{ $activity->description }}
                                                {{ $activity->created_at->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>

                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-xl-9 col-lg-8 col-xxl-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Registration History') }}</h4>
                </div>
                <div class="card-body">
                    <canvas id="registrationHistoryChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-xxl-4 col-md-4 col-sm-12">
            <div class="card" id="latest-registration">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('Latest Registrations')
                    </h4>
                    <a class="fs-5" href="{{ route('users.index') }}">@lang('View All')</a>
                </div>
                <div class="card-body">
                    @foreach ($resent_users as $user)
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <img class="rounded" src="{{ $user->avatar }}"
                                    alt="{{ $user->first_name }} {{ $user->last_name }} Avatar">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                {{ $user->first_name }} {{ $user->last_name }} <br/>{{ $user->created_at->diffForHumans() ?? 'N/A' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection


@push('footer')
    <script src="{{ admin_asset('js/Chart.bundle.min.js') }}"></script>
    <script>
        var chartjs = {
            label: @json(array_keys($registrationHistory)),
            value: @json(array_values($registrationHistory))
        }

        var loginPieChart = @json($loginPieChart);
    </script>
@endpush
