@extends('layouts.app')

@section('page_title', __('Post List'))

@section('page')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Post List') }}</h1>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                        {{ __('Create') }}
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Summary') }}</th>
                            <th><span>{{ __('Handle') }}</span></th>
                        </thead>
                        <tbody>
                            @foreach ($posts as $value)
                                <tr>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->summary }}</td>
                                    <td>
                                        <span class="d-flex justify-content-around">
                                            <a href="{{ route('posts.edit', $value->id) }}"
                                                class="btn btn-info text-white mr-1"><i class="fas fa-pen"></i></a>
                                            <a href="{{ route('posts.destroy', $value->id) }}"
                                                class="btn btn-danger text-white mr-1" data-toggle="tooltip"
                                                data-placement="top" title="@lang('Delete Page')" data-method="DELETE"
                                                data-confirm-title="@lang('Please Confirm')"
                                                data-confirm-text="@lang('Are you sure that you want to delete this post?')"
                                                data-confirm-button="@lang('Yes, delete post!')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
