<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield($page->title, __o('site_title'))</title>

<!-- Place favicon.ico in the root directory -->
<link rel="icon" type="image/png" href="{{ __o( 'site_favicon') }}">

{{-- seo  --}}
@include('theme::partials.seo', ['seo' => Seo::find($page->seo_id) ])

<!-- ========== Start Stylesheet ========== -->
<link href="{{ asset('themes/wokoya/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/fontawesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/bsnav.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/magnific-popup.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/slick.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/all.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/animate.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/icofont.min.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/splitting.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/splitting-cells.css') }}" rel="stylesheet" />
<link href="{{ asset('themes/wokoya/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('themes/wokoya/assets/css/responsive.css') }}" rel="stylesheet" />
<!-- ========== End Stylesheet ========== -->
