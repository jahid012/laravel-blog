
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ admin_asset('img/favicon.ico') }}">
    <title>@if (trim($__env->yieldContent('title')))@yield('title') | @endif {!! trans('installer_messages.title') !!}</title>
    <meta name="description" content="">
    <meta name=”robots” content=”noindex”>
    <meta name=”googlebot” content=”noindex”>
    {{-- Bootstrap core CSS --}}
    <link href="{{ admin_asset('css/bootstrap.css') }}" rel="stylesheet" >
    <link href="{{ admin_asset('css/main.css') }}" rel="stylesheet" >
    {{-- Custom styles for this template  --}}
    <link href="{{ admin_asset('css/installer.css') }}" rel="stylesheet">
    <link href="{{ admin_asset('css/all.min.css') }}" rel="stylesheet">
    <script src="{{ admin_asset('js/jquery.min.js') }}"></script>

</head>
  <body class="bg-light">
    <main class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-9 pb-md-4 mx-auto">
            <div class="my-3 p-5 bg-white rounded shadow-sm">
            @yield('page')
            </div>
        </div>
      </div>
    </main>
    <script src="{{ admin_asset('js/installer.js') }}"></script>
  </body>
</html>
