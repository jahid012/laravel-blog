<!-- Start Experience
============================================= -->
<div class="exp-area de-padding">
    <div class="container">
        <div class="site-title">
            <h2 class="site-tl">
                {{__('theme::exp-area.title')}}
            </h2>
        </div> <!-- end section title -->
        <div class="exp-wpr grid-3">
        @foreach (\Plugins\Qualification\Models\Qualification::get() as $experience)
            <div class="exp-box wow fadeInDown" data-wow-duration=".6s" data-wow-delay=".2s">
                <div class="exp-icon one">
                    <i class="{{ __($experience->icon) }}"></i>
                </div>
                <div class="exp-content">
                    <h4>{{ __($experience->name) }}</h4>
                    <p>{{ __($experience->institute) }} </p>
                    <span>({{ __($experience->start_at) }} - {{ __($experience->end_at) }})</span>
                </div>
            </div> <!-- end one -->
        @endforeach
        </div> <!-- end exp-wrp -->
    </div> <!-- end container -->
</div>
<!-- End Experience -->

<!-- Start Counter
============================================= -->
<div class="counter-area de-padding">
    <div class="shape-filter">
        <div class="shape-filter-one"></div>
        <div class="shape-filter-two"></div>
    </div>
    <div class="container"> <!-- start container-->
        <div class="counter-wpr grid-2"> <!-- start counter-wrp -->
            <div class="counter-left">
                <div class="counter-left-pic mt-20">
                        <div class="counter-left-img-area position-relative wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".3s">
                            <img src="{{asset( 'themes/wokoya-topbar/assets/img/counter-02.png')}}" alt="" class="thumbnail position-absolute" />
                            <img src="{{asset( 'themes/wokoya-topbar/assets/img/counter-01.png')}}" alt="" class="thumbnail-2 position-absolute mt-10 img-play-btn" />
                            <div class="video-box fl-wrap">
                                <a class="video-box-btn color-bg popup-vimeo image-popup" href="https://www.youtube.com/watch?v=SMKPKGW083c"><i class="fa fa-play" aria-hidden="true"></i></a>
                            </div>
                        </div>
                </div>
            </div>
            <div class="counter-content">
                <div class="site-title">
                    <h2 class="site-tl wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".4s">
                        My Previous Projects <br /> &amp; Clients Speak Out for Me
                    </h2>
                </div>
                <div class="counter-counter grid-2">
                    <div class="fun-fact">
                        <span class="fun-icon one"><i class="icofont-calendar"></i></span>
                        <div class="fun-desc">
                            <p class="timer" data-to="2550" data-speed="3000">{{ __('theme::about.workinghour') }}</p>
                            <span class="medium">Working Hours</span>
                        </div>
                    </div>
                    <div class="fun-fact fun-active">
                        <span class="fun-icon two"><i class="icofont-globe"></i></span>
                        <div class="fun-desc">
                            <p class="timer" data-to="550" data-speed="3000">{{ __('theme::about.totalproject') }}</p>
                            <span class="medium">Total projects</span>
                        </div>
                    </div>
                    <div class="fun-fact">
                        <span class="fun-icon three"><i class="icofont-bulb-alt"></i></span>
                        <div class="fun-desc">
                            <p class="timer" data-to="12" data-speed="3000">{{ __('theme::about.journey-year') }}</p>
                            <span class="medium">Years Journey</span>
                        </div>
                    </div>
                    <div class="fun-fact">
                        <span class="fun-icon four"><i class="icofont-nerd-smile"></i></span>
                        <div class="fun-desc">
                            <p class="timer" data-to="502" data-speed="3000">{{ __('theme::about.toatalclient') }}</p>
                            <span class="medium">Total Client</span>
                        </div>
                    </div>
                </div>
                <div class="hire-btn mt-60">
                    <a href="#contact" class="btn-2 smooth-scroll">
                    {{__('theme::exp-area.contact')}}
                    </a>
                </div> <!-- end btn-->
            </div>
        </div> <!-- end counter-wrp -->
    </div> <!-- end container -->
</div>
<!-- End Counter-->
