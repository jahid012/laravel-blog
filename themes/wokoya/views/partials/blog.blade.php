<div id="blog" class="blog-area de-padding">
	<div class="container pl-20">
		<div class="site-title text-center">
			<span class="top-title wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
				{{ __('theme::blog.title') }}
			</span>
			<h2 data-splitting class="about-tl-3 wow fadeInUp" data-wow-duration=".01s" data-wow-delay=".01s">
                {{__('theme::blog.subtitle') }}</h2>
		</div>
		<div class="blog-wpr blog-sldr">

            @foreach (\Plugins\Blog\Models\Post::limit(5)->with('auth')->get() as $post)
			<div class="blog-box">
				<div class="blog-pic">
					<img src="{{$post->featured_image }}" alt=" {{$post->title}} Post">
				</div>
				<div class="blog-info">
					<ul class="blog-meta">
						<li>
							<i class="icofont-user-alt-4"></i> Admin
						</li>
						<li>
							<i class="icofont-clock-time"></i> {{ $post->created_at->format('d M, y ') }}
						</li>
					</ul>
					<a href="{{route('post', $post->slug)}}">
						<h5 class="blog-title"> {{$post->title}} </h5>
					</a>
				</div>
			</div> <!-- end single blog -->
			@endforeach
		</div>


		<div class="row pt-70">
			<!-- start row-->
			<div class="col-md-12">
				<div class="download-cv-btn text-center">
					<a href="{{ route('blog') }}" class="theme-btn">Load More</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end container -->
</div>
