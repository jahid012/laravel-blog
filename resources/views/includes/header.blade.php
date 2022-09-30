<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <a href="{{ route('dashboard') }}" class="brand-logo">
        <img class="logo-abbr" src="{{ option('app_logo-abbr') }}" alt="">
        <img class="logo-compact" src="{{ option('app_logo-compact' ) }}" alt="">
        <img class="brand-title" src="{{ option('app_brand-title') }}" alt="">
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
{{-- **********************************
    Nav header end
********************************** --}}


{{-- **********************************
    Header start
********************************** --}}
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">

                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">

                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar }}" width="20" alt="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} Avatar"/>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('profile.index') }}" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="ml-2">@lang('Profile') </span>
                            </a>
                            <a href="{{ route('profile.activity') }}" class="dropdown-item ai-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                <span class="ml-2">@lang('Activity')</span>
                            </a>
                            <a href="{{ route('profile.session') }}" class="dropdown-item ai-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                                <span class="ml-2">@lang('Session')</span>
                            </a>

                            <a href="{{ route('logout') }}" class="dropdown-item ai-icon"  onclick="event.preventDefault(); document.getElementById('frm-header-logout').submit();">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ml-2">@lang('Logout') </span>
                            </a>
                            <form id="frm-header-logout" method="POST" action="{{ route('logout') }}" style="display: none;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            </form>
                        </div>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
{{-- **********************************
    Header end ti-comment-alt
********************************** --}}
