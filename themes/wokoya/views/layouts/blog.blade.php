@extends('theme::layouts.default')

@section('defaultContent')

    <main class="main">

        <!-- Start Hero
                  ============================================= -->
        <div id="home" class="hero-section hero-page">
            <div class="line_wrap">
                <!-- line animation -->
                <div class="line_item"></div>
                <div class="line_item"></div>
                <div class="line_item"></div>
                <div class="line_item"></div>
                <div class="line_item"></div>
            </div> <!-- end line animation -->
            <div class="container sidebar-toptext">
                <div class="row">
                    <div class="col-md-12">
                        <div class="head-top-contact">
                            <span class="phone_contact">{{ __o('site_phone') }}</span>
                            <span class="email_contact">{{ __o('site_email') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-single h-auto">
                <div class="container">
                    <!-- start container -->
                    <div class="row">
                        <!-- start row -->
                        <div class="col-md-6 col-sm-12 pl-20">
                            <!-- hero text left -->
                            <div class="hero-content wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".4s">
                                <h2 data-splitting class="top-title pt-30 wow fadeInUp" data-wow-duration=".001s"
                                    data-wow-delay=".001s">Our <span class="colored">Blog.</span>
                                </h2>

                            </div>
                        </div> <!-- hero left text end -->

                    </div>
                </div>
            </div>
            <!-- single Hero End -->

        </div>
        <!-- End Hero -->

        <!-- Start Blog
                  ============================================= -->
        <div id="blog" class="blog-area de-padding">
            <div class="container pl-20  min-vh-100">
                <div class="site-title text-center">

                    <h2 data-splitting class="about-tl-3">
                        {{ __('Newly Posted Articles') }}
                    </h2>
                </div>
                <div class="blog-wpr border-0">
                    <div class="row">
                        @foreach ($posts as $post)
                            <!-- start single blog -->
                            <div class="col-sm-12 col-md-3 col-lg-4">
                                <div class="blog-box">
                                    <div class="blog-pic">
                                        <img src="{{$post->featured_image }}" alt="thumb">
                                    </div>
                                    <div class="blog-info">
                                        <ul class="blog-meta">
                                            <li>
                                                <i class="icofont-user-alt-4"></i> {{ $post->auth->getFullName() }}
                                            </li>
                                            <li>
                                                <i class="icofont-clock-time"></i> {{ $post->created_at->format('d M, y ') }}
                                            </li>
                                        </ul>
                                        <a href="{{ route('post', $post->slug ) }}">
                                            <h5 class="blog-title">
                                                {{$post->title}}
                                            </h5>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <!-- end single blog -->
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                {{ $posts->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end container -->
        </div>
        <!-- End Blog -->

        @include('theme::partials.footer')
    </main>
@endsection
