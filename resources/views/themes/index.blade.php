@extends('layouts.app')

@section('page_title', __('theme.index.title'))


@section('page')
<div class="row" id="theme_list">
    @foreach ($themes as $value)
    <div class="col-lg-6 col-sm-12">
        <div class="card bg-white">
            <div class="card-body text-center">
                    <img class="img-fluid rounded" src='{{ asset("themes/{$value->shortname}") }}/assets/screenshot.png' alt="">
            </div>
            <div class="card-footer pt-0 pb-3 pl-3">
                <div class="pt-1 m-0 pb-0 pl-2 pr-0">
                    <p class="p-0 m-0">
                        <strong>{{ $value->getName() }}</strong>
                    </p>
                    <p class="p-0 m-0">
                        {{-- <strong>Description: </strong> --}}{{ $value->description }}
                    </p>
                    <p class="p-0 m-0">
                        <strong>Version: </strong>{{ $value->version }}
                    </p>
                    <p class="p-0 m-0">
                        <strong>Author: </strong>{{ $value->author_name }}
                    </p>
                </div>
                <div class="d-flex pt-2 m-0">
                    @if ($value->shortname == config('cms.theme'))
                    <div>
                        <button type="button" class="btn btn-success ml-2" disabled>
                            {{ __('theme.index.buttons.active') }}
                        </button>
                    </div>
                    @else
                    <form action="{{ route('themes.active') }}" method="post">
                        @csrf
                        <input type="hidden" name="shortname" value="{{$value->shortname}}">
                        <button type="submit" class="btn btn-primary ml-2 theme-enable-btn">
                            {{ __('theme.index.buttons.enable') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
