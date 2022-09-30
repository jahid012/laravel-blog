<div class="exp-area de-padding">
	<div class="container pl-20">
		<div class="site-title text-center">
			<span class="resume-title">{{ __('theme::exp-area.resume_title') }}</span>
			<h2 data-splitting class="about-tl-3 gr-2 wow fadeInUp" data-wow-duration=".01s" data-wow-delay=".01s">
				{{ __('theme::exp-area.resume_subtitle') }}
			</h2>
		</div>
		<!-- end section title -->
		<div class="exp-wpr row">
			<div class="col-md-6">
				<!-- start col-6 -->
				<div class="experience_area">
                    @foreach (\Plugins\Qualification\Models\Qualification::where('type', 'experience')->get() as $experience)
					<div class="exp-box mt-30 wow fadeInDown" data-wow-duration=".6s" data-wow-delay=".6s">
						<div class="exp-icon one"><i class="{{ __($experience->icon) }}"></i></div>
						<div class="exp-content">
							<h4>{{ __($experience->name) }}</h4>
							<p> {{ __($experience->institute) }} ({{ __($experience->start_at) }} - {{ __($experience->end_at) }})</p>
							<span class="exp-description pt-10">{!! __($experience->description) !!}</span>
						</div>
					</div>
					@endforeach
					<!-- end three -->
				</div>
			</div> <!-- end col-6 -->
			<div class="col-md-6">
				<!-- start col-6 -->
				<div class="education_area">
					<!-- end one -->
					@foreach (\Plugins\Qualification\Models\Qualification::where('type', 'education')->get() as $experience)
					<div class="exp-box mt-30 wow fadeInDown" data-wow-duration=".6s" data-wow-delay=".6s">
						<!-- start three -->
						<div class="exp-icon six">
                            <i class="{{ __($experience->icon) }}"></i>
                        </div>
						<div class="exp-content">
							<h4>{{ __($experience->name) }}</h4>
							<p> {{ __($experience->institute) }} ({{ __($experience->start_at) }} - {{ __($experience->end_at) }})</p>
							<span class="exp-description pt-10">{!! __($experience->description) !!}</span>
						</div>
					</div>
					@endforeach
					<!-- end three -->
				</div>
			</div> <!-- end col-6 -->
		</div> <!-- end exp-wrp row -->
		<div class="row">
			<!-- start row -->
			<div class="col-md-6">
				<!-- start col-6 -->
				<div class="progress-left pt-90">
					<div class="skill-section">
                        @foreach (\Plugins\Skill\Models\Skill::where('type', 'professional')->get() as $skill)
							<!-- Progress Bar Start -->
							<div class="progress-box">
								<h5>{{$skill->name}} <span class="pull-right">{{$skill->percentage}}%</span>
								</h5>
								<div class="progress">
									<div class="progress-bar" role="progressbar" data-width="{{$skill->percentage}}"></div>
								</div>
							</div>
							<!-- End Progressbar -->
						@endforeach
					</div>
				</div>
			</div> <!-- end col-6 -->
			<div class="col-md-6">
				<!-- start col-6 -->
				<div class="progress-right pt-90">
					<div class="skill-section">
                        @foreach (\Plugins\Skill\Models\Skill::where('type', 'language')->get() as $skill)
                            <!-- Progress Bar Start -->
                            <div class="progress-box">
                                <h5>{{$skill->name}} <span class="pull-right">{{$skill->percentage}}%</span>
                                </h5>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" data-width="{{$skill->percentage}}"></div>
                                </div>
                            </div>
                            <!-- End Progressbar -->
                        @endforeach
					</div>
				</div>
			</div> <!-- end col-6  -->
		</div> <!-- end row-->
		<div class="row pt-70">
			<!-- start row-->
			<div class="col-md-12">
				<div class="download-cv-btn text-center">
					<a href="{{ __('theme::exp-area.resume.download_cv_link') }}" class="theme-btn">
                    {{ __('theme::exp-area.resume_download_cv_text') }}</a>
				</div>
			</div>
		</div>
		<!-- end row-->
	</div> <!-- end container -->
</div>
