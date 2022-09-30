<div class="tab-pane fade" id="theme-o-tab-seo" role="tabpanel" aria-labelledby="theme-o-tab-seo-tab">

    <div class="mb-3">
        <label class="form-label">{{ __('SEO title ') }}</label>
        <input value="{{ __o('seo_title') }}" name="seo_title" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('SEO description') }}</label>
        <textarea name="seo_description" class="form-control" rows="3">{{ __o('seo_description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('SEO default Open Graph image ') }}</label>
        @if (__o('seo_ogimage'))
            <div id="post-thumbnail" class="media-picker-repaid">
                <input name="seo_ogimage" type="hidden" value="{{ __o('seo_ogimage') }}">
                <img src="{{ __o('seo_ogimage') }}">
            </div>
        @else
            <div id="post-thumbnail" class="media-picker">
                <input name="seo_ogimage" type="hidden" />
            </div>
        @endif
    </div>

</div>
