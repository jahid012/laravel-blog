<div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills my-2 w-25" id="theme-o-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active text-md-start text-sm-middle" data-bs-toggle="pill"
            data-bs-target="#theme-o-tab-general" type="button" role="tab" aria-controls="theme-o-tab-general"
            aria-selected="true">
            <i class="fas fa-home"></i> {{ __(' General') }}
        </button>
        <button class="nav-link text-md-start text-sm-middle" data-bs-toggle="pill"
            data-bs-target="#theme-o-tab-seo" type="button" role="tab" aria-controls="theme-o-tab-seo"
            aria-selected="true">
            <i class="fab fa-angellist"></i> {{ __(' Default Seo') }}
        </button>
        <button class="nav-link text-md-start text-sm-middle" data-bs-toggle="pill" data-bs-target="#theme-o-tab-logo"
            type="button" role="tab" aria-controls="theme-o-tab-logo" aria-selected="false">
            <i class="far fa-images"></i> {{ __(' Logo/Image') }}
        </button>
        <button class="nav-link text-md-start text-sm-middle" data-bs-toggle="pill" data-bs-target="#theme-o-tab-social"
            type="button" role="tab" aria-controls="theme-o-tab-social" aria-selected="false">
            <i class="fas fa-share-square"></i> {{ __(' Social') }}
        </button>
        <button class="nav-link text-md-start text-sm-middle" data-bs-toggle="pill" data-bs-target="#theme-o-tab-page"
            type="button" role="tab" aria-controls="theme-o-tab-page" aria-selected="false">
            <i class="fas fa-file"></i> {{ __(' Page') }}
        </button>
        <button class="nav-link text-md-start text-sm-middle" data-bs-toggle="pill" data-bs-target="#theme-o-tab-other"
            type="button" role="tab" aria-controls="theme-o-tab-other" aria-selected="false">
            <i class="fas fa-map-marked-alt"></i> {{ __(' Others') }}
        </button>
    </div>

    <div class="tab-content bg-white w-100 min-vh-100 my-2 py-3 px-4">
        @include('theme::options.general')

        @include('theme::options.images')

        @include('theme::options.seo')

        @include('theme::options.social')

        @include('theme::options.page')

        <div class="tab-pane fade" id="theme-o-tab-other" role="tabpanel" aria-labelledby="theme-o-tab-other-tab">
            <div class="mb-3">
                <label class="form-label">{{ __('Google map embed link') }}</label>
                <input type="text" name="google_map" value="{{__o('google_map')}}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Google Analytic') }}</label>
                <input type="text" name="google_analytic" value="{{__o('google_analytic')}}" class="form-control" placeholder="UA-XXXXXXXX-X">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('CV Link') }}</label>
                <input type="text" name="download_cv_link" value="{{__o('download_cv_link')}}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Disqus shortname') }}</label>
                <input type="text" name="disqus_shortname" value="{{__o('disqus_shortname')}}" class="form-control">
                <small>{{__('Internal Disqus commenting system')}}</small>
            </div>

        </div>
    </div>
</div>
