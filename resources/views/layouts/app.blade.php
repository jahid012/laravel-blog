<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <base href="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title') - {{option('app_name')}}</title>
    <meta name="description" content="{{ option('app_description') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ option('app_favicon') }}">

    <link href="{{ admin_asset('css/main.min.css') }}" rel="stylesheet">
    <link href="{{ admin_asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ admin_asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <script src="{{ admin_asset('js/main.min.js') }}"></script>

    @stack('head')
    @yield('head')
</head>

<body>

    {{-- *******************
        Preloader start
    ******************** --}}
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    {{-- *******************
        Preloader end
    ******************** --}}

    {{-- **********************************
        Main wrapper start
    *********************************** --}}
    <div id="main-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        {{-- **********************************
            Content body start
        *********************************** --}}
        <div class="content-body">
            <div class="container-fluid">

                @include('includes.make_storage_link')
                @include('includes.alerts')
                @if (session('status'))
                <div class="alert alert-primary" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                @yield('page')

            </div>
        </div>
        {{-- **********************************
            Content body end
        ********************************** --}}

        {{-- **********************************
            Footer start
        ********************************** --}}
        <div class="footer">
            <div class="copyright">
                <p>{!! option('app_copyright', "Copyright © <a href='/'>DUCOR</a> 2021") !!}</p>
            </div>
        </div>
        {{-- **********************************
            Footer end
        ********************************** --}}
    </div>
    {{-- **********************************
        Main wrapper end
    ********************************** --}}

    {{-- **********************************
        Toast Start
    ********************************** --}}

    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3">
        </div>
    </div>

    {{-- **********************************
        Toast end
    ********************************** --}}

    {{-- **********************************
        Scripts
    ********************************** --}}
    <script src="{{ admin_asset('js/form.min.js') }}"></script>
    <script src="{{ admin_asset('js/scripts.js') }}"></script>
    <script src="{{ admin_asset('js/form-script.js') }}"></script>
    <script src="{{ admin_asset('js/settings.js') }}"></script>
    <script data-du="customizers" src="{{ admin_asset('js/init.js') }}?url={{ route('customizers.quick') }}"></script>
    @if (config('cms.admin_customizer'))
    <script src="{{ admin_asset('js/styleSwitcher.js') }}"></script>
    @endif

    {!! Toastr::message() !!}

    @stack('footer')
    @yield('footer')
</body>

</html>
