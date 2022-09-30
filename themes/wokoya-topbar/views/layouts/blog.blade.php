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
                                Our Blog
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
                @foreach ($posts as $post)
                <div class="col-sm-12 col-md-3 col-lg-4 blog-box">
                    <!-- start single blog -->
                    <div class="blog-pic">
                        <img src="{{$post->featured_image }}" alt="{{$post->title}} Post">
                    </div>
                    <div class="blog-info">
                        <ul class="blog-meta">
                            <li><i class="icofont-user-alt-4"></i> {{ $post->auth->getFullName() }}</li>
                            <li><i class="icofont-clock-time"></i> {{ $post->created_at->format('d M, y ') }}</li>
                        </ul>
                        <a href="{{route('post', $post->slug)}}">
                            <h5 class="blog-title">
                                {{$post->title}}
                            </h5>
                        </a>

                    </div>
                </div> <!-- end single blog -->
                @endforeach
            </div>
            <div class="row pt-20">
                <div class="col">
                    <div class="text-center">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>
        </div> <!-- end container -->
    </div>
    <!-- End Blog -->
</main>

@include('theme::partials.footer2')

@endsection
