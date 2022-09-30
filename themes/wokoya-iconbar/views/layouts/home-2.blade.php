
@extends('theme::layouts.default')

@section('defaultContent')
<main class="main">

	<!-- Start Hero
		============================================= -->
    @include('theme::partials.hero-parallax')
	<!-- End Hero -->

	<!-- About us
		============================================= -->
	@include('theme::partials.about')
	<!-- About us -->

	<!-- Start Experience
		============================================= -->
	@include('theme::partials.exp-area')
	<!-- End Experience -->

	<!-- Start Services
		============================================= -->
	@include('theme::partials.service')
	<!-- End Services -->

	<!-- Start Hire Me
		============================================= -->
	@include('theme::partials.hireme')
	<!-- End Hire Me-->

	<!-- Start Faq
		============================================= -->
	@include('theme::partials.faq')
	<!-- End Faq -->

	<!-- Start Project Area
		============================================= -->
	@include('theme::partials.work')
	<!-- End Project Area -->

	<!-- Start Feedback
	============================================= -->
	@include('theme::partials.feedback')
	<!-- End Feedback -->

	<!-- Start Pricing
		============================================= -->
	@include('theme::partials.price-area')
	<!-- End Pricing -->

	<!-- Start Blog
		============================================= -->
	@include('theme::partials.blog')
	<!-- End Blog -->

	<div class="clearfix"></div>

	<!-- Start Footer
	============================================= -->
	@include('theme::partials.contact')
	<!-- End Footer-->
</main>

@endsection
