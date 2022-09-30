@extends('layouts.app')

@section('page_title', __('theme.index.options.title'))

@section('page')
    <div class="row">
        <div class="col">
            <div id="theme-option-header" class="mb-4">
                <div class="display_header">
                    <h2>{{ __('Theme Translate') }}</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="theme-option-body">
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('themes.translate') }}" method="get">
                            <div class="d-md-flex flex-row mb-3">

                                <div class="m-2">
                                    <label class="form-label visually-hidden">{{ __('Target Lang') }}</label>
                                    <select name="country_code" class="form-select">
                                        @foreach (languages(true) as $language)
                                            <option value="{{ $language->getIso6391() }}" @if ($language->getIso6391() == $country_code) {{ ' selected' }} @endif>
                                                {{ $language->getName() . ' -- ' . $language->getNativeName() . ' -- (' . $language->getIso6391() . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="m-2">
                                    <label class="form-label visually-hidden">{{ __('Group Name') }}</label>
                                    <select name="group" class="form-select">
                                        @foreach ($lang_file_names as $file_name)
                                            <option value="{{ $file_name }}" @if ($file_name == $group)  selected @endif>
                                                {{ $file_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-2 d-grid gap-2 d-md-block pt-2">
                                    <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if ($langs)
                        <div class="card-body">
                            <form
                                action="{{ route('themes.languages_update', ['country_code' => $country_code, 'group' => $group]) }}"
                                method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 d-none d-sm-block">
                                        {{ __('theme.translate.lang_key') }}
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        {{ app()->getLocale() }} -
                                        {{ language(app()->getLocale(), true)->getName() }} (default)
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        {{ $country_code }} - {{ language($country_code, true)->getName() }}
                                    </div>
                                </div>
                                <hr />
                                @foreach ($langs as $key => $value)
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 d-none d-sm-block">
                                            <code key="{{ $key }}">{{ "theme::{$group}.{$key}" }}</code>
                                        </div>
                                        <div class="col-sm-12 col-md-4">{!! $value !!}</div>
                                        <div class="col-sm-12 col-md-4">
                                            <input type="hidden" name="keys[]" value="{!! $key !!}">
                                            <textarea name="values[]" class="form-control"
                                                rows="2">{!! __("theme::{$group}.{$key}", [], $country_code) !!}</textarea>
                                        </div>
                                    </div>
                                    <hr />
                                @endforeach

                                <div class="float-end">
                                    <button type="reset" class="btn btn-warning"
                                        onclick="javascript:if(!confirm('Do you want to reset this form')){ event.preventDefault() }">reset</button>
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </form>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

