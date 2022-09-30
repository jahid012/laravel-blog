@extends('layouts.app')

@section('page_title', __('Media Manager'))

@section('page')

    <style>
        .media-tb-image {
            height: 100px;
            width: 100px;
        }

    </style>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex">

                    <h1>{{ __('Media Manager') }}</h1>
                    <form id="upload-form" method="POST" action="{{ route('media.store') }}" class="ms-auto"
                        enctype="multipart/form-data">
                        @csrf
                        <button class="btn btn-primary" type="submit">Upload</button>
                        <input name="files[]" type="file" style="display: none;" multiple>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form method="GET" id="media-page-form">
                                <ul class="list-group list-group-horizontal">
                                    <li class="list-group-item">
                                        <input value="" type="hidden" name="year">
                                        <input value="" type="hidden" name="month">
                                        <select class="form-select mx-auto" aria-label="Default select example">
                                            @foreach ($directories as $key => $name)
                                            <option value="{{$key}}" @if($q == $key)  selected @endif>{{$name}}</option>
                                            @endforeach
                                          </select>
                                    </li>
                                    <li class="list-group-item">
                                        <button type="submit" class="btn btn-primary">{{__("Search")}}</button>
                                    </li>
                                  </ul>


                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @csrf
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">{{ __('Image') }}</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Handle') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            {{-- <th scope="row">
                                            <input name="files[]" class="form-check-input" type="checkbox"
                                                value="{{ $file->path }}">
                                        </th> --}}
                                            <td>
                                                <div class="media-tb-image">
                                                    <img src="{{ $file->url() }}" class="img-thumbnail" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                {{ $file->basename }}
                                            </td>
                                            <td>
                                                <a href="{{ route('media.destroy', $file->path) }}"
                                                    class="btn btn-danger text-white mr-1" data-toggle="tooltip"
                                                    data-placement="top" title="@lang('Delete User')" data-method="DELETE"
                                                    data-confirm-title="@lang('Please Confirm')"
                                                    data-confirm-text="@lang('Are you sure that you want to delete this file?')"
                                                    data-confirm-button="@lang('Yes, delete file!')">
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
@endsection

@push('footer')
    <script>
        $(document).ready(function() {
            $("#upload-form button").on('click', function(e) {
                e.preventDefault();
                $("#upload-form input").click();
            });

            $("#upload-form input").on('change', function(e) {
                e.preventDefault();
                if ($(this)[0].files.length) {
                    $("#upload-form").submit();
                }
            });

            //filter search form
            var date = $("#media-page-form select").val().split('/');
            $("#media-page-form input[name='year']").val(date[0]);
            $("#media-page-form input[name='month']").val(date[1]);
            var data = $("#media-page-form select").on('change', function(){
                var date = $(this).val().split('/');
                $("#media-page-form input[name='year']").val(date[0]);
                $("#media-page-form input[name='month']").val(date[1]);
            });

        });
    </script>
@endpush
