@extends('layouts.app')

@section('page_title', __('Theme Languages'))

@section('page')
    <div class="row">
        <div class="col">
            <div id="theme-option-header" class="mb-4">
                <div class="display_header">
                    <h2>{{ __('Theme Languages') }}</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="theme-option-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3 my-3">
                        <form action="{{ route('themes.languages.store') }}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label">{{ __('Name') }}</label>
                                <select name="country_code" class="form-select">
                                    @foreach (languages(true) as $language)
                                        <option value="{{ $language->getIso6391() }}">
                                            {{ $language->getName() . ' -- ' . $language->getNativeName() . ' -- (' . $language->getIso6391() . ')' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
                            </div>

                        </form>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{__("Code")}}</th>
                                            <th scope="col">{{__("Name")}}</th>
                                            <th scope="col">{{__("Handle")}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($languages as $code => $language)
                                        <tr>
                                            <th scope="row">{{$loop->index+1}}</th>
                                            <td>{{$code}}</td>
                                            <td>{{$language}}</td>
                                            <td>
                                                <a href="{{ route('themes.translate', ['country_code' => $code ]) }}" class="btn btn-dark mr-1">
                                                    <i class="fas fa-language  text-white"></i>
                                                </a>
                                                <a href="{{ route('themes.languages.destroy', $code ) }}"
                                                    class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                                    title="@lang('Delete Language')" data-method="DELETE"
                                                    data-confirm-title="@lang('Please Confirm')"
                                                    data-confirm-text="@lang('Are you sure that you want to delete this Language?')"
                                                    data-confirm-button="@lang('Yes, delete!')">
                                                    <i class="fas fa-times  text-white"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
