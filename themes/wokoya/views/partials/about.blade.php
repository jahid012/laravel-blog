<div id="about" class="about-area de-padding">
	<div class="line_wrap">
		<!-- line animation -->
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
	</div> <!-- end line animation -->
	<div class="about-wpr mt-20">
		<!-- start about -->
		<div class="container pl-20">
			<!-- container -->
			<div class="row">
				<!-- row -->
				<div class="col-md-5 mb-50">
					<div class="about-left wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".2s">
						<div class="about-header-img">
							<img src="{{ __o('about_image') }}" alt="about me" class="responsive-fluid bounce-animate">
						</div>
					</div>
				</div> <!-- about left text end -->
				<div class="col-md-7">
					<!-- col-7 -->
					<div class="about-right wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".5s">
						<span class="top-title">{{ __('theme::about.name') }}</span>
						<h2 data-splitting class="about-tl-3 gr-2 wow fadeInUp" data-wow-duration=".01s"
							data-wow-delay=".1s">{{ __('theme::about.tagline') }}</h2>
						<p class="wow fadeInUp" data-wow-duration=".2s" data-wow-delay=".2s">
							{!! __('theme::about.description') !!}
						</p>
						<div class="row">
							<!-- row -->
							<div class="col-md-6 col-sm-12">
								<!-- col-6 -->
								<div class="about-cn">
									<ul>
										<li>{!! __('theme::about.introname') !!}</li>
										<li>{!! __('theme::about.introskype') !!}</li>
										<li>{!! __('theme::about.introemail') !!}</li>
									</ul>
								</div>
							</div> <!-- end col-6 -->
							<div class="col-md-6 col-sm-12">
								<!-- col-6 -->
								<div class="about-cn">
									<ul>
										<li>{!! __('theme::about.introaddress') !!}</li>
										<li>{!! __('theme::about.introdateofbirth') !!}</li>
										<li>{!! __('theme::about.introphone') !!}</li>
									</ul>
								</div>
							</div> <!-- end col-6 -->
						</div> <!-- end row -->
					</div> <!-- end about right -->
				</div> <!-- end col-7 -->
			</div> <!-- end row -->
			<div class="counter-counter grid-4">
				<!-- start counter -->
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
			</div> <!-- end counter -->
		</div> <!-- end container -->
	</div> <!-- end about wrp -->
</div>
