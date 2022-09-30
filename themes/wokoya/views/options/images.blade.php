<div class="tab-pane fade" id="theme-o-tab-logo" role="tabpanel" aria-labelledby="theme-o-tab-logo-tab">

    <div class="mb-3">
        <label>{{__("Logo")}}</label>
        @if( __o('site_logo'))
        <div id="post-thumbnail" class="media-picker-repaid">
            <input name="site_logo" type="hidden" value="{{ __o('site_logo')}}">
            <img src="{{ __o('site_logo')}}">
        </div>
        @else
        <div id="post-thumbnail" class="media-picker">
            <input name="site_logo" type="hidden" />
        </div>
        @endif
    </div>

    <div class="mb-3">
        <label>{{__("Favicon")}}</label>
        @if( __o('site_favicon'))
        <div id="post-thumbnail" class="media-picker-repaid">
            <input name="site_favicon" type="hidden" value="{{ __o('site_favicon')}}">
            <img src="{{ __o('site_favicon')}}">
        </div>
        @else
        <div id="post-thumbnail" class="media-picker">
            <input name="site_favicon" type="hidden" />
        </div>
        @endif
    </div>

    <div class="mb-3">
        <label>{{__("Hero Image")}}</label>
        @if( __o('hero_image'))
        <div id="post-thumbnail" class="media-picker-repaid">
            <input name="hero_image" type="hidden" value="{{ __o('hero_image')}}">
            <img src="{{ __o('hero_image')}}">
        </div>
        @else
        <div id="post-thumbnail" class="media-picker">
            <input name="hero_image" type="hidden" />
        </div>
        @endif
    </div>

    <div class="mb-3">
        <label>{{__("About Image")}}</label>
        @if( __o('about_image'))
        <div id="post-thumbnail" class="media-picker-repaid">
            <input name="about_image" type="hidden" value="{{ __o('about_image')}}">
            <img src="{{ __o('about_image')}}">
        </div>
        @else
        <div id="post-thumbnail" class="media-picker">
            <input name="about_image" type="hidden" />
        </div>
        @endif
    </div>

</div>
