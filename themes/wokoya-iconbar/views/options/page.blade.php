<div class="tab-pane fade" id="theme-o-tab-page" role="tabpanel" aria-labelledby="theme-o-tab-page-tab">

    <div class="mb-3">
        <label class="form-label">{{ __('Home page Setting') }}</label>
        <select name="page_home" class="form-control">
            @foreach ($pages as $page)
                <option value="{{ $page->id }}" @if($page->id == __o('page_home') ) selected @endif>{{ $page->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Blog page Setting') }}</label>
        <select name="page_blog" class="form-control">
            @foreach ($pages as $page)
                <option value="{{ $page->id }}"  @if($page->id == __o('page_blog') ) selected @endif>{{ $page->title }}</option>
            @endforeach
        </select>
    </div>

</div>
