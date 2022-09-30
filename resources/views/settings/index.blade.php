@extends('layouts.app')

@section('page_title', __('Application Settings'))

@section('page')
    <div class="row">

        <div class="col-sm-12 col-md-6 my-3">
            <div class="widget-stat card mb-0 h-auto">
                <div class="card-body p-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 ai-icon bg-info p-4">
                            <i class="fas fa-tools fa-5x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 my-3">
                            <h3>{{__("General")}}</h3>
                            <p>{{__("General Setting")}}</p>
                            <a href="{{ route('settings.general')}}" class="card-cta">{{__("Change Setting")}} <i class="fas fa-chevron-right mx-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 my-3">
            <div class="widget-stat card mb-0 h-auto">
                <div class="card-body p-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 ai-icon bg-info p-4">
                            <i class="fas fa-pallet fa-5x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 my-3">
                            <h3>{{__("Authentication")}}</h3>
                            <p>{{__("Authentication Setting")}}</p>
                            <a href="{{ route('settings.auth')}}" class="card-cta">{{__("Change Setting")}} <i class="fas fa-chevron-right mx-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 my-3">
            <div class="widget-stat card mb-0 h-auto">
                <div class="card-body p-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 ai-icon bg-info p-4">
                            <i class="fas fa-bell fa-5x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 my-3">
                            <h3>{{__("Notifications")}}</h3>
                            <p>{{__("Notifications Setting")}}</p>
                            <a href="{{ route('settings.notifications')}}" class="card-cta">{{__("Change Setting")}} <i class="fas fa-chevron-right mx-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 my-3">
            <div class="widget-stat card mb-0 h-auto">
                <div class="card-body p-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 ai-icon bg-info p-4">
                            <i class="fas fa-envelope fa-5x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 my-3">
                            <h3>{{__("Mail")}}</h3>
                            <p>{{__("Mail Setting")}}</p>
                            <a href="{{ route('settings.mail')}}" class="card-cta">{{__("Change Setting")}} <i class="fas fa-chevron-right mx-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
