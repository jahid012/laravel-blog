
<div id="seo-card" class="card h-auto mb-3">
    <div class="card-header">
        <h2 class="card-title">{{ __('Search Engine Optimize') }}</h2>
        <button type="button" id="seo-card-body-toggle" class="btn btn-primary">{{ __('Edit Seo Meta') }}</button>
    </div>
    <div class="card-body">
        <div class="seo-card-body">

            <div class="accordion" id="accordionSeo">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#seoOne" aria-expanded="true" aria-controls="seoOne">
                            {{ __('Primary Meta Tags') }}
                        </button>
                    </h2>
                    <div id="seoOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionSeo">
                        <div class="accordion-body">
                            <button type="button" id="GetPrimaryMetaTagsBtn" class="btn btn-secondary my-2">{{__("Get General Meta")}}</button>
                            <div class="mb-3 @error('title') has-error @enderror">
                                <label>{{ __('Title') }}</label>
                                <input name="seo[title]" value="{{ old('title', $seo->title ) }}" class="form-control">
                                @error('title')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('description') has-error @enderror">
                                <label>{{ __('Description') }}</label>
                                <textarea name="seo[description]"
                                    class="form-control">{{ old('description', $seo->description ) }}</textarea>
                                @error('description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('keywords') has-error @enderror">
                                <label>{{ __('Keywords') }}</label>
                                <input name="seo[keywords]" value="{{ old('keywords', $seo->keywords ) }}" class="form-control">
                                @error('keywords')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#seoTwo" aria-expanded="false" aria-controls="seoTwo">
                            {{ __('Open Graph / Facebook') }}
                        </button>
                    </h2>
                    <div id="seoTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionSeo">
                        <div class="accordion-body">
                            <button type="button" id="GetOgMetaTagsBtn" class="btn btn-secondary my-2">{{__("Get OG Meta form General")}}</button>

                            <div class="mb-3 @error('og_type') has-error @enderror">
                                <label>{{ __('OG Type') }}</label>
                                <input name="seo[og_type]" value="{{ old('og_type', $seo->og_type ) }}" class="form-control">
                                @error('og_type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('og_title') has-error @enderror">
                                <label>{{ __('OG Title') }}</label>
                                <input name="seo[og_title]" value="{{ old('og_title', $seo->og_title ) }}" class="form-control">
                                @error('og_title')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('og_description') has-error @enderror">
                                <label>{{ __('OG Description') }}</label>
                                <textarea name="seo[og_description]" class="form-control">{{ old('og_description', $seo->og_description ) }}</textarea>
                                @error('og_description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('og_image') has-error @enderror">
                                <label>{{ __('OG Image') }}</label>
                                @if($seo->og_image)
                                <div class="text-center media-picker-repaid">
                                    <input name="seo[og_image]" type="hidden" value="{{$seo->og_image}}">
                                    <img src="{{$seo->og_image}}" class="img-thumbnail">
                                </div>
                                @else
                                <div  class="media-picker text-center">
                                    <input name="seo[og_image]" type="hidden" />
                                </div>
                                @endif
                                @error('og_image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#seoThree" aria-expanded="false" aria-controls="seoThree">
                            {{ __('Twitter Meta Tags') }}
                        </button>
                    </h2>
                    <div id="seoThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionSeo">
                        <div class="accordion-body">
                            <button type="button" id="GetTwitterMetaTagsBtn" class="btn btn-secondary my-2">{{__("Get Twitter Meta From Facebook")}}</button>

                            <div class="mb-3 @error('seo[twitter_card]') has-error @enderror">
                                <label>{{ __('Twitter Card') }}</label>
                                <input name="seo[twitter_card]" value="{{ old('twitter_card', $seo->twitter_card ) }}" class="form-control" >
                                @error('twitter_card')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('twitter_title') has-error @enderror">
                                <label>{{ __('Twitter Title') }}</label>
                                <input name="seo[twitter_title]" value="{{ old('twitter_title', $seo->twitter_title ) }}"
                                    class="form-control">
                                @error('twitter_title')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('twitter_description') has-error @enderror">
                                <label>{{ __('Twitter Description') }}</label>
                                <textarea name="seo[twitter_description]" class="form-control">{{ old('twitter_description', $seo->twitter_description ) }}</textarea>
                                @error('twitter_description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 @error('twitter_image') has-error @enderror">
                                <label>{{ __('Twitter Image') }}</label>

                                @if($seo->twitter_image)
                                <div class="text-center media-picker-repaid">
                                    <input name="seo[twitter_image]" type="hidden" value="{{$seo->twitter_image}}">
                                    <img src="{{$seo->twitter_image}}" class="img-thumbnail">
                                </div>
                                @else
                                <div  class="media-picker text-center">
                                    <input name="seo[twitter_image]" type="hidden" />
                                </div>
                                @endif
                                @error('twitter_image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
