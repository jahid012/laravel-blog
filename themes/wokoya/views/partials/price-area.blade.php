<div class="price-area de-padding">
	<div class="container pl-20">
		<!-- start container -->
		<div class="site-title text-center">
			<span class="top-title wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".3s">
                {{ __('theme::price.title') }}
            </span>
			<h2 data-splitting class="about-tl-3 wow fadeInUp" data-wow-duration=".01s" data-wow-delay=".01s">
                {{ __('theme::price.subtitle')  }}
            </h2>
		</div>
		<div class="price-wrapper grid-3">
			<!-- start price-area -->
            @foreach (\Plugins\Price\Models\Price::get() as $price)
			<div class="price-box mt-20 wow fadeInRight" data-wow-duration=".5s" data-wow-delay=".5s">
				<!-- single price -->
				<div class="price-head">
					<div class="price-icon price-icon-three">
                        <i class="{{ $price->icon }}"></i>
                    </div>
					<div class="price-rib">
						<span>{{ $price->name }}</span>
					</div>
					<div class="price-value">
						<h2>{{ $price->price }}</h2>
					</div>
				</div>
				<div class="price-info">{!! $price->info !!}</div>
				<div class="price-bottom">
					<a href="{{ $price->link }}" class="btn-2">{{ __('theme::price.buy_text') }}</a>
				</div>
			</div>
			@endforeach
			<!-- end single price-->
		</div> <!-- end price-area -->
	</div> <!-- end container -->
</div>
