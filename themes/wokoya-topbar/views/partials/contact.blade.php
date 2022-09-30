
<div class="container"> <!-- start container -->
    <div class="site-title text-center pt-80">
        <span class="top-title wow fadeInUp" data-wow-duration=".4s" data-wow-delay=".6s">  {{ __('theme::contact.title') }}</span>
        <h2 class="site-tl wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".8s">
              {{ __('theme::contact.subtitle') }}
        </h2>
    </div>
    <div class="row"> <!-- start row -->
        <div class="col-md-7">
            <div class="contact-area mb-20">
                <div class="contact-left mt-20">
                    <form class="contact-form" id="contact-form" action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".2s">
                                <input type="text" name="subject" class="form-control input-style-2" placeholder="Subject">
                            </div>
                            <div class="col-md-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".3s">
                                <input type="text" name="name" class="form-control input-style-2" placeholder="Your name">
                            </div>
                            <div class="col-md-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".4s">
                                <input type="email" name="email" class="form-control input-style-2" placeholder="Your Email Here">
                            </div>
                            <div class="col-12 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".5s">
                                <textarea class="form-control input-style-2" name="message" placeholder="Drop Message"></textarea>
                            </div>
                            <div class="col-4 wow fadeInUp" data-wow-duration=".6s" data-wow-delay=".6s">
                                <button type="submit" class="theme-btn mt-30">
                                    {{ __('theme::contact.sendme') }}
                                </button>
                            </div>
                            <div class="col-8 mt-50">
                                <div class="form-message"></div>
                                @include('includes.alerts')
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
                        <div class="addr mt-10 wow fadeInUp" data-wow-duration=".3s" data-wow-delay=".3s">
                            <div class="contact-right-icon one">
                                <i class="icofont-google-map"></i>
                            </div>
                            <p class="mb-0 mt-10">
                            {!! __o('site_address') !!}
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="addr mt-10 wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
                            <div class="contact-right-icon two">
                                <i class="icofont-envelope"></i>
                            </div>
                            <p class="mb-0 mt-10">
                            {{ __o('site_email') }}
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="addr mt-10 wow fadeInUp" data-wow-duration=".7s" data-wow-delay=".7s">
                            <div class="contact-right-icon three">
                                <i class="icofont-brand-whatsapp"></i>
                            </div>
                            <p class="mb-0 mt-10">
                            {{ __o('site_phone') }}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div> <!-- end col-5 -->
    </div> <!-- end row -->
</div> <!-- end container -->

