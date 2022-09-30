		<!-- Start Blog
		============================================= -->
		<div id="blog" class="blog-area de-padding">
			<div class="container">
				<div class="site-title text-center">
					<span class="top-title wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">{{ __('theme::blog.title') }}</span>
					<h2 class="site-tl wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".7s">
                    {{__('theme::blog.subtitle') }}
					</h2>
				</div>
				<div class="blog-wpr blog-sldr owl-carousel owl-theme">
                    @foreach (\Plugins\Blog\Models\Post::limit(5)->with('auth')->get() as $post)
                    <div class="blog-box"> <!-- start single blog -->
						<div class="blog-pic">
							<img src="{{$post->featured_image }}" alt="{{$post->title}} Post">
						</div>
						<div class="blog-info">
							<ul class="blog-meta">
								<li><i class="icofont-user-alt-4"></i> {{ $post->auth->getFullName() }}</li>
								<li><i class="icofont-clock-time"></i> {{ $post->created_at->format('d M, y ') }}</li>
							</ul>
							<a href="{{route('post', $post->slug)}}">
								<h5 class="blog-title">
                                {{$post->title}}
								</h5>
							</a>
							<div class="blog-btn">
								<a href="{{route('post', $post->slug)}}" class="btn-4 hv">
									<i class="icofont-arrow-right"></i>
								</a>
							</div>
						</div>
					</div> <!-- end single blog -->
                    @endforeach
				</div>
                <div class="text-center">
                <a class="btn-2" href="{{route('blog') }}">Load More</a>
                </div>
			</div> <!-- end container -->
		</div>
		<!-- End Blog -->
