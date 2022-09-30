<div id="service" class="service-area de-padding">
	<div class="container pl-20">
		<div class="site-title text-center">
			<!-- service section title -->
			<span class="resume-title">{{ __("theme::service.title") }}</span>
			<h2 data-splitting class="about-tl-3 gr-2 wow fadeInUp" data-wow-duration=".01s" data-wow-delay=".01s">
                {{ __("theme::service.subtitle") }}
            </h2>
		</div>
		<div class="row">
			<!-- start row -->
            @foreach (\Plugins\Service\Models\Service::all() as $service)
			<div class="col-md-4 col-sm-6">
				<div class="service-box mt-30 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".8s">
					<div class="service-icon service-three">
                        <i class="{{ $service->icon }}"></i>
                    </div>
					<div class="service-info">
						<h2>{{ $service->name }}</h2>
						<ul>{!! $service->description !!}</ul>
					</div>
				</div> <!-- end service six -->
			</div>
			@endforeach

			<!-- end col-4 -->
		</div> <!-- end row -->
	</div> <!-- end container -->
</div>
