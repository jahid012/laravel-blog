<div id="feed" class="feedback-area de-padding">
	<div class="line_wrap">
		<!-- line animation -->
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
	</div> <!-- end line animation -->
	<div class="container pl-20">
		<!-- start container -->
		<div class="site-title text-center">
			<span class="resume-title text-center wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
			{{ __('theme::feedback.title') }}
			</span>
			<h2 data-splitting class="about-tl-3 gr-2 wow fadeInUp" data-wow-duration=".01s" data-wow-delay=".01s">
			{{ __('theme::feedback.subtitle') }}
			</h2>
		</div> <!-- end section title -->
		<div class="feedback-wpr feed-sldr">
			<!-- start feedback-wpr -->
            @foreach (\Plugins\Testimonial\Models\Testimonial::get() as $quote)
			<div class="feedback-box">
				<div class="feedback-pc"><i class="icofont-quote-left"></i></div>
				<p>{!! $quote->quote !!}</p>
				<div class="feedback-desc">
					<img src="{{ $quote->author_image }}" alt="{{ $quote->author_name }} Author">
					<div class="feedback-bio">
						<h5 class="fz-20 l-h-1">{{ $quote->author_name }}</h5>
						<span class="fz-16 l-h-1">{{ $quote->author_intro }}</span>
					</div>
				</div>
			</div>
			@endforeach
			<!-- end single feedback -->
		</div> <!-- end feedback-wpr -->
	</div> <!-- end container -->
</div>
