@extends('layouts.app')

@section('page_title', __('Contact List'))

@section('page')

    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <h1>{{__("Contact Messages")}}</h1>
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                    <th class="border-bottom">{{__('Name')}}</th>
                    <th class="border-bottom">{{__('Phone')}}</th>
                    <th class="border-bottom">{{__('Created At')}}</th>
                    <th class="border-bottom">{{__('Status')}}</th>
                    <th class="border-bottom">{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>
                            <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="d-flex align-items-center">
                                <div class="d-block"><span class="fw-bold">{{ $contact->name }}</span>
                                    <div class="small text-gray">{{ $contact->email }}</div>
                                </div>
                            </a>
                        </td>
                        <td><span class="fs-normal">{{ $contact->phone }}</span></td>
                        <td>
                            <span class="fs-normal d-flex align-items-center">
                                {{ $contact->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            @if ($contact->is_read)
                                <span class="fs-normal badge bg-success">read</span>
                            @else
                                <span class="fs-normal badge bg-warning"> Unread</span>
                            @endif
                        </td>
                        <td>
                            <span class="d-flex justify-content-around">

                                <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-primary mr-1"
                                    data-toggle="tooltip" data-placement="top" title="@lang('Edit User')">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if (auth()->id() != $contact->id)
                                    <a href="{{ route('admin.contacts.destroy', $contact->id) }}"
                                        class="btn btn-danger text-white mr-1" data-toggle="tooltip" data-placement="top"
                                        title="@lang('Delete User')" data-method="DELETE"
                                        data-confirm-title="@lang('Please Confirm')"
                                        data-confirm-text="@lang('Are you sure that you want to delete this contact message?')"
                                        data-confirm-button="@lang('Yes, delete!')">
                                        <i class="fas fa-times  text-white"></i>
                                    </a>
                                @else
                                    <button class="btn btn-danger mr-1" title="@lang('Current LoggedIn user')" disabled>
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif

                            </span>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            {{ $contacts->links() }}
        </div>
    </div>
@endsection
