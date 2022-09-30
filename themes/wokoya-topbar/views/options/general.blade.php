<div class="tab-pane fade show active" id="theme-o-tab-general" role="tabpanel"
    aria-labelledby="theme-o-tab-general-tab">

    <div class="mb-3">
        <label class="form-label">{{ __('Site title ') }}</label>
        <input name="site_title" value="{{ __o('site_title') }}" class="form-control" />
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Site Shortname') }}</label>
        <input name="site_name" value="{{ __o('site_name') }}" class="form-control" />
    </div>

    <div class="mb-3">
        <label class="form-label">{!! __("Show site name after page title, separate with '-'?") !!}</label>
        <select value="{{ __o('title_separate') }}" name="title_separate" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Site description') }}</label>
        <textarea name="site_description" class="form-control" rows="3">{{ __o('site_description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Address') }}</label>
        <input value="{{ __o('site_address') }}" name="site_address" class="form-control" />
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Email') }}</label>
        <input value="{{ __o('site_email') }}" name="site_email" class="form-control" />
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Phone') }}</label>
        <input value="{{ __o('site_phone') }}" name="site_phone" class="form-control" />
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Copyright') }}</label>
        <input value="{{ __o('site_copyright') }}" name="site_copyright" class="form-control" />
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Footer Links') }}</label>
        <textarea name="site_footer_links" class="form-control">{{ __o('site_footer_links') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Social Links') }}</label>
        <textarea name="site_socials" class="form-control">{{ __o('site_socials') }}</textarea>
    </div>

</div>
