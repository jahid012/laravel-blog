<header class="header">
    <div class="main-navigation sd-nav">
        <div class="navbar navbar-expand-lg bsnav bsnav-sidebar bsnav-scrollspy bsnav-sidebar-left">
            <a class="navbar-brand mb-20" href="{{ route('home') }}">
                <img src="{{__o('site_logo')}}" class="logo-display" alt="{{ __('theme::header.name') }} Logo">
                <span class="profile_name">{{ __('theme::header.full_name') }}</span>
            </a>
            <button class="navbar-toggler toggler-spring"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-sm-center pt-20">
                <ul class="navbar-nav navbar-mobile mr-0">
                    {!! menu('site', 'theme::menu') !!}

                </ul>
            </div>
            <div class="sidebar-copyright pt-10">
                <p class="copyright">{{__o('site_name')}}</p>
            </div>
        </div>
        <div class="bsnav-mobile">
            <div class="bsnav-mobile-overlay"></div>
            <div class="navbar"></div>
        </div>
    </div>
</header>
<!-- Header End -->
