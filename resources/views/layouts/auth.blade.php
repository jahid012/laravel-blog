<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('page_title', option('app_name') . " - " . option('app_description'))</title>
    <meta name="description" content="{{ option('app_description') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ option('app_favicon', url('default/favicon.ico')) }}">
    <link href="{{ asset('themes/admin/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="h-100">

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                            @yield('page')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- **********************************
        Scripts
    ********************************** --}}
</body>

</html>

