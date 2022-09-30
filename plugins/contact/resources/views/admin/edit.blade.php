@extends('layouts.app')

@section('page_title', __('Contact information'))

@section('page')

    <div class="row">
        <div class="col">
            <div id="post-type" class="card h-auto mb-3">
                <div class="card-header">
                    <h1 class="card-title">{{ __(' Contact information') }}</h1>
                </div>
                <div class="card-body">

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Time') }}</label>
                        <div class="col-sm-10">
                            <input readonly class="form-control-plaintext" value="{{ $contact->created_at }}">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Full Name') }}</label>
                        <div class="col-sm-10">
                            <input readonly class="form-control-plaintext" value="{{ $contact->name }}">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-10">
                            <input readonly class="form-control-plaintext" value="{{ $contact->email }}">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Phone') }}</label>
                        <div class="col-sm-10">
                            <input readonly class="form-control-plaintext" value="{{ $contact->phone }}">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                        <div class="col-sm-10">
                            <textarea readonly class="form-control-plaintext">{{ $contact->address }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Subject') }}</label>
                        <div class="col-sm-10">
                            <textarea readonly class="form-control-plaintext">{{ $contact->subject }}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div id="post-type" class="card h-auto mb-3">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Replay Message') }}</h1>
                </div>
                <div class="card-body">

                    @foreach ($children as $ch)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1 ms-3 bg-light p-2">
                            {!!$ch->message!!}
                        </div>
                    </div>
                    @endforeach

                    <form action="{{ route('admin.contacts.replay', $contact->id) }}" method="post">
                        @csrf
                        <div>
                            <textarea name="message"
                                class="summernote @error('message')  is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="my-3">
                            <button type="submit" class="btn btn-primary">{{ __('Replay') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-auto">
            <form action="{{ route('admin.contacts.update', $contact->id) }}" method="post">
                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Publish') }}
                        </h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> {{ __(' Update') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h3 class="border-bottom pb-2">
                            {{ __('Status') }}
                        </h3>
                        <div class="d-grid gap-2">
                            @method('PUT')
                            @csrf
                            <select name="is_read" class="form-control">
                                <option value="1" @if ($contact->is_read == 1) selected @endif>Read</option>
                                <option value="0" @if ($contact->is_read == 0) selected @endif>Unread</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('footer')

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                toolbar: [
                    // [groupName, [list of button]]

                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', false],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],

            });

        });
    </script>
@endpush
