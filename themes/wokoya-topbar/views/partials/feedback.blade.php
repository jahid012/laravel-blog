<!-- Start Feedback
============================================= -->
<div id="feed" class="feedback-area de-padding">
    <div class="container"> <!-- start container -->
        <div class="site-title text-center">
            <span class="top-title wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
            {{__('theme::feedback.title')}}
            </span>
            <h2 class="site-tl wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".7s">
                {{__('theme::feedback.subtitle')}}
            </h2>
        </div> <!-- end section title -->
        <div class="feedback-wpr feed-sldr owl-carousel owl-theme"> <!-- start feedback-wpr -->
            @foreach (\Plugins\Testimonial\Models\Testimonial::get() as $quote)
            <div class="feedback-box">
                <div class="feedback-pc">
                    <i class="icofont-quote-left"></i>
                </div>
                <p>
                {!! $quote->quote !!}
                </p>
                <div class="feedback-desc">
                    <img src="{{ $quote->author_image }}" alt="{{ $quote->author_name }}">
                    <div class="feedback-bio">
                        <h5 class="fz-20 l-h-1">{{ $quote->author_name }}</h5>
                        <span class="fz-16 l-h-1">{{ $quote->author_intro }}</span>
                    </div>
                </div>
            </div>
            <!-- end single feedback -->
            @endforeach
        </div> <!-- end feedback-wpr -->
    </div> <!-- end container -->
</div>
<!-- End Feedback -->
