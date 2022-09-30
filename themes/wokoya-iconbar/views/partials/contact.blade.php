<footer id="contact" class="footer">
    <div class="container pl-20">
        <!-- start container -->
        <div class="site-title text-center pt-80">
            <span class="resume-title contact-title wow fadeInUp" data-wow-duration=".4s" data-wow-delay=".6s">
                {{ __('theme::contact.title') }}
            </span>
            <h2 data-splitting class="about-tl-3 wow fadeInUp" data-wow-duration=".01s" data-wow-delay=".01s">
                {{ __('theme::contact.subtitle') }}
            </h2>
        </div>
        <div class="row">
            <!-- start row -->
            <div class="col-md-7">
                <div class="contact-area">
                    <div class="contact-left mt-20">
                        <form class="contact-form" id="contact-form" action="{{ route('contacts.store') }}"
                            method="POST">
                            <div class="row g-4">
                                <div class="col-md-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".2s">
                                    <input type="text" name="subject" class="form-control input-style-2"
                                        placeholder="Subject">
                                </div>
                                <div class="col-md-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".3s">
                                    <input type="text" name="name" class="form-control input-style-2"
                                        placeholder="Your name">
                                </div>
                                <div class="col-md-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".4s">
                                    <input type="email" name="email" class="form-control input-style-2"
                                        placeholder="Your Email Here">
                                </div>
                                <div class="col-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".5s">
                                    <textarea class="form-control input-style-2" name="message"
                                        placeholder="Drop Message"></textarea>
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-duration=".6s"
                                    data-wow-delay=".6s">
                                    <button type="submit" class="theme-btn send-me mt-30 text-center">
                                        {{ __('Send Me') }}
                                    </button>
                                </div>
                                <div class="col-12 text-center wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".5s">
                                    <p class="form-message">@include('includes.alerts')</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end contact-area -->
            </div> <!-- end col-7 -->
            <div class="col-md-5">
                <div class="contact-right mt-40">
                    <ul>
                        <li>
                            <div class="addr mt-10 wow fadeInUp" data-wow-duration=".3s" data-wow-delay=".8s">
                                <div class="contact-right-icon two">
                                    <i class="icofont-envelope"></i>
                                </div>
                                <p class="mb-0 contact_itext">{{ __o('site_email') }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="addr mt-10 wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".8s">
                                <div class="contact-right-icon three">
                                    <i class="icofont-brand-whatsapp"></i>
                                </div>
                                <p class="mb-0 contact_itext">{{ __o('site_phone') }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="addr mt-10 wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".8s">
                                <div class="contact-right-icon one">
                                    <i class="icofont-google-map"></i>
                                </div>
                                <p class="mb-0 contact_itext">{{ __o('site_address') }}</p>
                            </div>
                        </li>
                    </ul>
                    <div class="gmap-area mt-10">
                        <!-- start gmap -->
                        <iframe class="embed-responsive-item" src="{{ __o('google_map') }}" style="border:0;"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div> <!-- end gmap -->
                </div>
            </div> <!-- end col-5 -->
        </div> <!-- end row -->
    </div> <!-- end container -->

    <div class="copyright-area">
        <!-- start copyright -->
        <div class="container">
            <!-- container -->
            <div class="row">
                <div class="col-md-5 mt-50">
                    <div class="copyright-left wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".7s">
                        <span class="copyright-text">{{ __o('site_copyright') }}</span>
                    </div>
                </div> <!-- end col-5 -->
                <div class="col-md-4 mt-50">
                    <div class="copyright-right wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".8s">
                        <div class="copyright-menu">
                            {!! __o('site_footer_links') !!}
                        </div>
                    </div>
                </div> <!-- end col-4 -->
                <div class="col-md-3 mt-50">
                    <div class="copyright-social wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".9s">
                        <ul class="footer-social">
                            {!! __o('site_socials') !!}
                        </ul>
                    </div>
                </div> <!-- end col-3 -->
            </div>
        </div> <!-- end container -->
    </div> <!-- end copyright area -->
</footer>
