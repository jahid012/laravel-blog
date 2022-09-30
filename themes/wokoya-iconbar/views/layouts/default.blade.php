<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    @include('theme::partials.head')
</head>

<body class="side-header" data-spy="scroll" data-target=".navbar" data-offset="1">

	<!-- Preloader -->
	@include('theme::partials.preloader')
	<!-- Preloader End -->

	<div class="theme_all_wrap" data-magic-cursor=" " data-color="crimson">

		<!-- Document Wrapper
=============================== -->
		<div id="main-wrapper">
			<!-- Start header
    ============================================= -->

        @include('theme::partials.header')
			<!-- Header End -->

			<div class="clearfix"></div>


			<div class="main-area-width">
				@yield('defaultContent')
			</div>

			<!-- Start Scroll top -->
			<a href="#home" id="scrtop" class="smooth-scroll">
                <i class="icofont-rounded-up"></i>
            </a>
			<!-- End Scroll top-->

			<!-- CURSOR -->
			<div class="mouse-cursor cursor-outer"></div>
			<div class="mouse-cursor cursor-inner"></div>
			<!-- /CURSOR -->
		</div>
	</div> <!-- Mouse Cursor End -->

	<!-- jQuery Frameworks
    ============================================= -->

    @include('theme::partials.scripts')
</body>

</html>
