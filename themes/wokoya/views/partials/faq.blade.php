<div class="fq-area de-padding">
	<div class="container pl-20">
		<!-- start container -->
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="faq-wpr">
					<!-- start faq-wpr -->
					<div class="fq-right">
						<div class="faqs-title pb-30 text-center">
							<span class="resume-title">{{ __('theme::faq.title') }}</span>
							<h2 data-splitting class="faqs-subtitle about-tl-3 gr-2 wow fadeInUp"
								data-wow-duration=".01s" data-wow-delay=".01s"> {{ __('theme::faq.subtitle') }}</h2>
						</div>
						<div class="site-title wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".2s">
							<div class="accordion" id="accordionExample">
                                @foreach (\Plugins\Faq\Models\Faq::get() as $faq )
								<div class="accordion-item">
									<h2 class="accordion-header" id="heading{{$loop->index}}">
										<button class="accordion-button collapsed" type="button"
											data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}"
											aria-expanded="false" aria-controls="collapse{{$loop->index}}">
											{{ $faq->ask}}
										</button>
									</h2>
									<div id="collapse{{$loop->index}}" class="accordion-collapse collapse"
										aria-labelledby="heading{{$loop->index}}" data-bs-parent="#accordionExample">
										<div class="accordion-body">{{ $faq->answer }}</div>
									</div>
								</div>
                                @endforeach

								<!-- End accordion item -->
							</div>
							<!-- End accordion -->
						</div> <!-- end site-title -->
					</div> <!-- end faq-right -->
				</div> <!-- End faq-wpr -->
			</div> <!-- end col-8 -->
		</div> <!-- end row -->
	</div> <!-- end container -->
</div>
