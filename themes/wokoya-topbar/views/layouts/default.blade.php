<!doctype html>
<html class="no-js" lang="zxx">

<head>
    @include('theme::partials.head')
</head>

<body class="side-header" data-spy="scroll" data-target=".navbar" data-offset="1">

    @include('theme::partials.preloader')

    <div class="theme_all_wrap" data-magic-cursor=" " data-color="crimson">

        <!-- Document Wrapper
=============================== -->
        <div id="main-wrapper">
            <!-- Start header
    ============================================= -->

            @include('theme::partials.header')

            @yield('defaultContent')
            <!-- CURSOR -->
            <div class="mouse-cursor cursor-outer"></div>
            <div class="mouse-cursor cursor-inner"></div>
            <!-- /CURSOR -->
        </div>
    </div> <!-- Mouse Cursor End -->
    @include('theme::partials.scripts')
</body>

</html>
