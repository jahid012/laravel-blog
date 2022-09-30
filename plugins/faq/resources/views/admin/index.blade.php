@extends('layouts.app')

@section('page_title', __('Frequently asked question'))

@section('page')
    <div class="card h-auto mb-3">
        <div class="card-header">
            <h1 class="card-title">{{ __('Frequently asked question') }}</h1>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Ask') }}</th>
                        <th scope="col">{{ __('Answer') }}</th>
                        <th scope="col">{{ __('Handle') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->ask }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-info text-white mr-1">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{ route('admin.faqs.destroy', $faq->id) }}"
                                        class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                        title="@lang('Delete Page')" data-method="DELETE"
                                        data-confirm-title="@lang('Please Confirm')"
                                        data-confirm-text="@lang('Are you sure that you want to delete this Faq?')"
                                        data-confirm-button="@lang('Yes, delete !')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
