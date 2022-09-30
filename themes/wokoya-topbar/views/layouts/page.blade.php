@extends('theme::layouts.default')

@section('defaultContent')

<main class="main">

    <!-- Start Hero
============================================= -->
    <div id="home" class="hero-section hero-section-bg my-auto">
        <div class="animate_shape position-relative">
            <div class="animation_shape position-abolute shape-01"></div>
            <div class="animation_shape position-abolute shape-02"></div>
            <div class="animation_shape position-abolute shape-03"></div>
            <div class="animation_shape position-abolute shape-04"></div>
            <div class="animation_shape position-abolute shape-05"></div>
        </div>
        <div class="vh-50 hero-single">
            <div class="container">
                <!-- start container -->
                <div class="row">
                    <!-- start row -->
                    <div class="col">
                        <!-- hero text left -->
                        <div class="mt-40 wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".6s">
                            <h2 class="text-16 mb-2 mb-md-3">
                            {{$page->title }}
                            </h2>
                        </div>
                    </div>
                    <!-- hero left text end -->

                </div>
            </div>
        </div><!-- single Hero End -->

    </div>
    <!-- End Hero -->

    <!-- Start Blog
		============================================= -->
    <div id="blog" class="blog-area de-padding">
        <div class="container">

            <div class="row">
                <div class="my-5">
                    @if ($page->featured_image)
                        <img src="{{ $page->featured_image }}" class="img-fluid" alt="{{ $page->title }} Post">
                    @endif
                </div>
            </div>

            <div class="row">
            {!! $page->content !!}
            </div>

        </div> <!-- end container -->
    </div>
    <!-- End Blog -->
</main>

@include('theme::partials.footer2')

@endsection
