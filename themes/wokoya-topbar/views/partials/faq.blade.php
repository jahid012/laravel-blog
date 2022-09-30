<!-- Start Faq
============================================= -->
<div class="fq-area de-padding">
    <div class="faq-shape">
        <div class="thumbnail-2 faq-shape-one"></div>
    </div>
    <div class="container"> <!-- start container -->
        <div class="faq-wpr grid-2"> <!-- start faq-wpr -->
            <div class="fq-left mb-30">
                <div class="faq-pic wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".3s">
                    <img src="{{asset( 'themes/wokoya-topbar/assets/img/faqs-1.png') }}" alt="thumb">
                </div>
            </div>
            <div class="fq-right">
                <div class="site-title wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".2s">
                    <h2 class="site-tl mb-0">
                        {!!__('theme::faq.title')!!}
                    </h2>
                </div>
                    <div id="accordionExample">
                        @foreach (\Plugins\Faq\Models\Faq::get() as $faq )
                        <div class="card accordion-item mt-20">
                            <div class="card-header" id="heading{{$loop->index}}">
                                <h5 class="mb-0">
                                    <button class="accordion-button btn btn-link" type="button"
                                        data-toggle="collapse" data-target="#collapse{{$loop->index}}"
                                        aria-expanded="false" aria-controls="collapse{{$loop->index}}">
                                        {{ $faq->ask}}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{$loop->index}}" class="collapse @if($loop->first) show @endif"
                                aria-labelledby="heading{{$loop->index}}" data-parent="#accordionExample">
                                <div class="card-body">{{ $faq->answer }}</div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div> <!-- end faq-wpr -->
    </div> <!-- end container -->
</div>
<!-- End Faq -->
