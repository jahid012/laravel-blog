<!-- Start Project Area
============================================= -->
<section id="work" class="portfolio_bg de-padding">
	<div class="container"> <!-- start container -->
		<div class="row"> <!-- row -->
			<div class="col-md-3"> <!-- portfolio left menu -->
				<div class="site-title work_section_title">
					<span class="top-title wow fadeInUp" data-wow-duration=".4s" data-wow-delay=".3s">
                    {{__('theme::work.title')}}
					</span>
					<h2 class="site-tl wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".4s">
                    {{__('theme::work.subtitle')}}
					</h2>
				</div>
				<ul class="col list-unstyled list-inline mb-0 text-uppercase work_menu" id="menu-filter">
					<li class="list-inline-item"><a class="active" data-filter="*">All</a></li>
                    @foreach (\Plugins\Portfolio\Models\Portfolio::select('category')->groupby('category')->get() as $work)
					<li class="list-inline-item"><a class="" data-filter=".{{Str::slug($work->category)}}">{{$work->category}}</a></li>
                    @endforeach
				</ul>
			</div> <!-- end portfolio menu -->
			<div class="col-md-9"> <!-- portfolio img -->
				<div class="container"> <!-- container -->
					<div class="row mt-4 work-filter">
                    @foreach (\Plugins\Portfolio\Models\Portfolio::all() as $work)
                     <!-- start col-4 -->
						<div class="col-md-4 work_item {{Str::slug($work->category)}}">
							<a href="{{ $work->image }}" class="img-zoom">
								<div class="work_box">
									<div class="work_img">
										<img src="{{ $work->image }}" class="img-fluid mx-auto d-block rounded" alt="{ $work->title }} work">
									</div>
									<div class="work_detail">
										<p class="mb-2">{{ $work->category }}</p>
										<h4 class="mb-0">{{ $work->title }}</h4>
									</div>
								</div>
							</a>
						</div>
                         <!-- end col-4 -->
                        @endforeach
				</div>
			</div> <!-- end container -->
		</div> <!-- end portfolio img -->
	</div>
	</div>
</section>
		<!-- End Project Area -->
