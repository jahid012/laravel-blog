<section id="work" class="portfolio_bg de-padding">
	<div class="line_wrap">
		<!-- line animation -->
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
		<div class="line_item"></div>
	</div> <!-- end line animation -->
	<div class="container">
		<!-- start container -->
		<div class="row">
			<!-- row -->
			<div class="col-md-5 pl-20">
				<!-- col-5 -->
				<div class="site-title work_section_title">
					<span class="top-title wow fadeInUp" data-wow-duration=".4s" data-wow-delay=".3s">
						{{ __('theme::work.title') }}
					</span>
					<h2 data-splitting class="about-tl-3 gr-2 wow fadeInUp" data-wow-duration=".01s"
						data-wow-delay=".01s">{{ __('theme::work.subtitle') }}
					</h2>
				</div>
			</div>
			<!-- end col-5 -->
			<div class="col-md-7">
				<!-- start col-7 -->
				<ul class="col list-unstyled list-inline mb-0 text-uppercase work_menu mt-50" id="menu-filter">
					<li class="list-inline-item"><a class="active" data-filter="*">All</a></li>
					@foreach (\Plugins\Portfolio\Models\Portfolio::select('category')->groupby('category')->get() as $work)
						<li class="list-inline-item">
							<a class="" data-filter=".{{Str::slug($work->category)}}">{{$work->category}}</a>
						</li>
					@endforeach
				</ul>
			</div>
			<!-- end col-7 -->
		</div>
		<!-- end row -->
		<div class="row row-full-width">
			<div class="col-md-12">
				<!-- start col-9 -->
				<div class="container portfolio-container">
					<!-- container -->
					<div class="row work-filter">
						@foreach (\Plugins\Portfolio\Models\Portfolio::all() as $work)
						<div class="col-md-4 work_item {{Str::slug($work->category)}}">
							<a href="{{ $work->image }}" class="img-zoom">
								<div class="work_box">
									<div class="work_img">
										<img src="{{ $work->image }}" class="img-fluid mx-auto d-block rounded"
											alt="{{ $work->title }} Portfolio">
									</div>
									<div class="work_detail">
										<p class="mb-2">{{ $work->category }}</p>
										<h4 class="mb-0">{{ $work->title }}</h4>
									</div>
								</div>
							</a>
						</div>
						@endforeach
						<!-- end col-4 -->
					</div>
				</div> <!-- end container -->
			</div>
			<!-- start col-9 -->
		</div>
		<!-- end row -->
	</div>
	<!-- end container -->
</section>
