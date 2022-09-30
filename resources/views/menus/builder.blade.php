@extends('layouts.app')

@section('page_title', __('Menu Builder'))

@section('page')
    <form method="post" action="{{ route('menus.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Menu Builder') }}</h1>
                        <button class="btn btn-primary create" type="button" data-bs-toggle="modal"
                            data-bs-target="#menu-form-modal" href="{{ route('menus.additem', $menu->id) }}">{{ __('Add') }} </button>
                    </div>
                    <div class="card-body">

                        <div id="dd-alert" class="alert alert-success" role="alert" style="display: none;"></div>

                        <div class="dd" id="nestable3">
                            {!! menu($menu->name, 'builder' ) !!}
                        </div>
                        <input id="nestable2-output" type="hidden" />
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- add menu item Modal -->
    <form method="post" action="{{ route('menus.additem', $menu->id) }}">
        <div class="modal fade" id="menu-form-modal" tabindex="-1" aria-labelledby="menu-form-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Menu Item') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">{{ __('Title') }}</label>
                            <input name="title" class="form-control" required min="3" max="10">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Url') }}</label>
                            <input name="url" class="form-control" required min="1" max="255">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Target') }}</label>
                            <select name="target" class="form-control">
                                <option value="_self">_self</option>
                                <option value="_blank">_blank</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('Icon Class') }}
                                (Use a <a href="https://dropways.github.io/feathericons/" target="_blank"> Feather Icons </a>)
                            </label>
                            <input name="icon_class" class="form-control" max="50">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__("Close")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("Save")}}</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection


@push('head')
    <link  rel="stylesheet" href="{{ admin_asset('css/jquery.nestable.min.css') }}" />
@endpush

@push('footer')
<script src="{{ admin_asset('js/jquery.nestable.min.js') }}"></script>

<script>
    $(document).ready(function () {

        $('.dd').nestable({
            expandBtnHTML: '',
            collapseBtnHTML: ''
        });

        /**
         * Reorder items
         */
        $('.dd').on('change', function (e) {
            $.post("{{ route('menus.orderitem',['menu' => $menu->id]) }}", {
                order: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function (data) {
                try {
                    toastr[data['alert-type']](data.message);
                } catch (error) {
                    toastr.primary(data.message);
                }
            }).fail(function(){
                alert("Order Fail.");
                window.location.reload();
            });
        });
    });
</script>
@endpush
