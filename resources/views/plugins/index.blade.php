@extends('layouts.app')

@section('page_title', __('Plugins'))

@section('page')

    <div class="row" id="addon_list">
        @foreach ($data as $value)
            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card">
                    <img src="{{ asset("plugins/{$value->getName()}/assets/screenshot.png") }}" class="card-img-top" style="width: 100%; height: 100px;"
                        alt="{{ $value->title }} Plugin">
                    <div class="pb-0 pt-0 card-body">
                        <p class="pb-0 pt-0 mb-1 mt-0">{{ $value->getName() }}</p>
                    </div>

                    <div class="card-footer pt-0 pb-3 pl-3">
                        <div class="pt-1 m-0 pb-0 pl-0 pr-0">
                            <p class="p-0 m-0">{{ $value->description }}</p>
                            <p class="p-0 m-0">By: <strong>{{ $value->author_name }}</strong>
                            </p>
                            <p class="p-0 m-0">Version: {{ $value->version }}</p>
                        </div>
                        <div class="d-flex pt-1 m-0">
                            <button type="submit" class="btn btn-success" disabled>
                                {{ __('plugin.index.buttons.enabled') }}
                            </button>
                            @if ($value->hasOption())
                            <a href="{{ route('plugins.options', ['name' => $value->name]) }}"
                                class="btn btn-primary mx-2" @if (!$value->hasOption()) disabled @endif>
                                {{ __('plugin.index.buttons.options') }}
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
