
<!-- Start Hero
============================================= -->
<div id="home" class="hero-section hero-section-bg">
    <div class="animate_shape position-relative">
        <div class="animation_shape position-abolute shape-01"></div>
        <div class="animation_shape position-abolute shape-02"></div>
        <div class="animation_shape position-abolute shape-03"></div>
        <div class="animation_shape position-abolute shape-04"></div>
        <div class="animation_shape position-abolute shape-05"></div>
        <div class="animation_shape position-abolute shape-06"></div>
    </div>
    <div class="hero-single">
        <div class="container">	<!-- start container -->
            <div class="row">	<!-- start row -->
                <div class="col-md-6">	<!-- hero text left -->
                    <div class="hero-content mt-40 wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".6s">
                        <span class="top-title wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".7s">{{__('theme::hero.first_name') }} {{__('theme::hero.last_name') }}</span>
                        <h2 class="text-16 header_type_text text-white mb-2 mb-md-3">
                            I'm Creative Designer
                        </h2>
                        <p class="header-intro-text wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".8s">
                        {!! __('theme::hero.introtext') !!}
                        </p>
                        <div class="hro-btn wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".9s">
                            <a href="{{ __o('download_cv_link') }}" class="theme-btn">
                            {!! __('theme::hero.download_cv_text') !!}
                            </a>
                        </div>
                    </div>
                </div>	<!-- hero left text end -->
                <div class="col-md-6">	<!-- hero right img animation -->
                    <div class="hero-right wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".6s">
                        <img src="{{asset( 'themes/wokoya-topbar/assets/img/hr-02.png') }}" alt="" class="thumbnail" />
                        <img src="{{asset( 'themes/wokoya-topbar/assets/img/hr-01.png') }}" alt="" class="thumbnail-2 mt-10" />
                    </div>
                </div>	<!-- hero right img animation  end -->
            </div>
        </div>
    </div><!-- single Hero End -->
    <div class="about-scroll-down text-center">
        <a href="#about" class="scroll-down-arrow scroll_down smooth-scroll"><i class="icofont-scroll-bubble-down"></i></a>
    </div>
</div>
<!-- End Hero -->
