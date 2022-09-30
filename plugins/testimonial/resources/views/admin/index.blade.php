@extends('layouts.app')

@section('page_title', 'Testimonial List')

@section('page')

    {{-- Page body --}}
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Testimonial List') }}</h3>
                    <a class="btn btn-primary" href="{{ route('admin.testimonials.create') }}">
                        {{ __('Create') }}
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Author Name') }}</th>
                                <th scope="col">{{ __('Author Image') }}</th>
                                <th scope="col">{{ __('Author Intro') }}</th>
                                <th scope="col">{{ __('Handle') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $value)
                                <tr>
                                    <th scope="row">{{ $value->author_name }}</th>
                                    <td>
                                        <img src="{{ $value->author_image }}" class="img-thumbnail" alt="">
                                    </td>
                                    <td>{{ $value->author_intro }}</td>
                                    <td>
                                        <a href="{{route('admin.testimonials.edit', $value->id )}}" class="btn btn-info text-white mr-1"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('admin.testimonials.destroy', $value->id) }}"
                                            class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                            title="@lang('Delete Page')" data-method="DELETE"
                                            data-confirm-title="@lang('Please Confirm')"
                                            data-confirm-text="@lang('Are you sure that you want to delete this testimonial?')"
                                            data-confirm-button="@lang('Yes, delete !')">
                                            <i class="fas fa-times"></i>
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
@endsection
