<div id="home" class="hero-section hero-section-bg" style="background-image: url('{{__o('hero_image')}}')">
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
    <div class="top-contact">
        <a href="#contact" class="top-contact-btn smooth-scroll">
            <i class="icofont-envelope"></i>
        </a>
    </div>

    <div class="hero-single sidebar-hero-bg">
        <div class="container">
            <!-- start container -->
            <div class="row">
                <!-- start row -->
                <div class="col-md-6 col-sm-12 pl-20">
                    <!-- hero text left -->
                    <div class="hero-content wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".6s">
                        <h2 data-splitting class="top-title pt-30 wow fadeInUp" data-wow-duration=".001s"
                            data-wow-delay=".001s">{{__('theme::hero.first_name') }}
                            <span class="colored">{{__('theme::hero.last_name' )}}.</span>
                        </h2>
                        <div class="typed-strings">{!! __('theme::hero.description') !!}</div>
                        <p class="text-16 header_type_text text-white mb-2 mb-md-3">
                            <span class="typed"></span>
                        </p>
                        <p class="header-intro-text wow fadeInUp pt-10" data-wow-duration=".6s" data-wow-delay=".8s">I
                            {!! __('theme::hero.introtext') !!}
                        </p>
                        <div class="hro-btn wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".9s">
                            <a href="{{ __o('download_cv_link') }}" class="theme-btn">
                                {!! __('theme::hero.download_cv_text') !!}
                            </a>
                        </div>
                    </div>
                </div> <!-- hero left text end -->
                <div class="col-md-5 col-sm-12 mt-50">
                    <!-- col-6 -->
                    <div class="right-social-icon">
                        <ul class="social-icon">
                            <li><a href="{{__o('social_facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{__o('social_dribbble')}}"><i class="fab fa-dribbble"></i></a></li>
                            <li><a href="{{__o('social_behance')}}"><i class="fab fa-behance"></i></a></li>
                            <li><a href="{{__o('social_linkedin')}}"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>
        </div>
    </div>
    <!-- single Hero End -->
    <div class="about-scroll-down text-center">
        <a href="#about" class="scroll-down-arrow scroll_down smooth-scroll">
            <i class="icofont-scroll-bubble-down"></i>
        </a>
    </div>
</div>
