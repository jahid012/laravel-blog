<!-- About us
============================================= -->
<div id="about" class="about-area de-padding">
    <div class="about-wpr">
        <div class="container">
            <!-- container -->
            <div class="row">
                <!-- row -->
                <div class="col-md-6 mb-50">
                    <div class="about-left wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".2s">
                        <div class="about-header-left">
                            <h2 class="about-tl gr-bg wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".4s">
                                {!! __('theme::about.left.title') !!}
                            </h2>
                            <h4 class="about-tl-2 mb-20"> {!! __('theme::about.left.subtitle') !!}</h4>
                            <a href="#contact" class="smooth-scroll btn-3">{!! __('theme::about.left.contact') !!}</a>
                        </div>
                    </div>
                </div> <!-- about left text end -->
                <div class="col-md-6">
                    <div class="about-right wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".5s">
                        <span class="top-title">{{__('theme::about.full_name')}}</span>
                        <h2 class="about-tl-3 gr-2">
                        {{__('theme::about.intro')}}
                            Design is not only art but also
                            science and commerce as well
                        </h2>
                        <p>
                        {{__('theme::about.description')}}
                        </p>
                        <div class="about-cn">
                            <ul>
                                <li><i class="far fa-envelope"></i> {{__('theme::about.mail')}}</li>
                                <li><i class="fab fa-whatsapp"></i> {{__('theme::about.phone')}}</li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- about right text end -->
            </div> <!-- end row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="progress-left pt-80">
                        <div class="skill-section">
                        @foreach (\Plugins\Skill\Models\Skill::where('type', 'professional')->get() as $skill)
                            <!-- Progress Bar Start -->
                            <div class="progress-box">
                                <h5>{{$skill->name}} <span class="pull-right">{{$skill->percentage}}%</span></h5>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" data-width="{{$skill->percentage}}"></div>
                                </div>
                            </div>
                        @endforeach
                            <!-- End Progressbar -->
                        </div>
                    </div>
                </div> <!-- end col-6 -->
                <div class="col-md-6">
                    <div class="progress-right pt-80">
                        <div class="skill-section">
                        @foreach (\Plugins\Skill\Models\Skill::where('type', 'language')->get() as $skill)
                            <!-- Progress Bar Start -->
                            <div class="progress-box">
                                <h5>{{$skill->name}} <span class="pull-right">{{$skill->percentage}}%</span></h5>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" data-width="{{$skill->percentage}}"></div>
                                </div>
                            </div>
                        @endforeach
                            <!-- End Progressbar -->
                        </div>
                    </div>
                </div> <!-- end col-6  -->
            </div> <!-- end row-->
        </div> <!-- end container -->

    </div> <!-- end about wrp -->
</div>
<!-- About us -->
