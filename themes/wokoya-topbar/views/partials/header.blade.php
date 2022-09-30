<!-- Header -->
<header id="header" class="sticky-top position-absolute bg-transparent">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top custom-nav sticky">

        <div class="container position-relative"> 	<!-- start container -->

        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-brand pt-0 logo">
            <span class="profile-image">
                <img class="img-fluid profile_img" src="{{__o('site_logo')}}" title="{{ __('theme::header.name') }}" alt="{{ __('theme::header.name') }} Logo">
            </span>
        </a>
        <!-- Logo End -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="icofont-navigation-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
            {!! menu('site', 'theme::menu') !!}
            </ul>
        </div>
        <div class="header-serarch-btn">
            <a class="smooth-scroll btn-2" href="#contact">hire me</a>
        </div>
        </div> 	<!-- Container End -->
    </nav>
    <!-- Navbar End -->
    </header>
    <!-- Header End -->

<div class="clearfix"></div>


