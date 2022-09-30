<!-- Start Services
============================================= -->
<div id="service" class="service-area de-padding">
    <div class="container">
        <div class="site-title text-center"> <!-- service section title -->
            <span class="top-title">My Services</span>
            <h2 class="site-tl">
                A brief of Offerting Services
            </h2>
        </div>
        <div class="service-wpr grid-3">
        @foreach (\Plugins\Service\Models\Service::all() as $service)
            <!-- start service-wpr -->
            <div class="service-box wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".3s">
                <div class="sershp1">
                </div>
                <div class="service-icon service-one">
                    <i class="icofont-vector-path"></i>
                </div>
                <div class="service-info">
                    <h2>Graphic Design</h2>
                    <ul>
                        <li>Logo design</li>
                        <li>Web UI </li>
                        <li>Business card crafting</li>
                        <li>Package design</li>
                        <li>Web banner </li>
                        <li>Flyer & Brochure</li>
                        <li>Social Media Package</li>
                    </ul>
                </div>
            </div> <!-- end service one -->
        @endforeach
        </div> <!-- end service wrp -->
    </div> <!-- end container -->
</div>
<!-- End Services -->
