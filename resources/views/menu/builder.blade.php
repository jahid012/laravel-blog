<ol class="dd-list">
    @foreach ($items as $item)
        <li class="dd-item item_actions" data-id="{{ $item->id }}">
            <div class="float-end px-2 pt-2">
                <div class="btn btn-sm btn-danger text-white delete" data-id="{{ $item->id }}"
                    href="{{ route('menus.destroyitem', [ 'menuItem' => $item->id ]) }}"
                    title="@lang('Delete User')" data-method="DELETE" data-confirm-title="@lang('Please Confirm')"
                    data-confirm-text="@lang('Are you sure that you want to delete this Menu Item?')"
                    data-confirm-button="@lang('Yes, delete')">
                    <i class="far fa-trash-alt"></i> {{ __('Delete') }}
                </div>
                <div class="btn btn-sm btn-primary edit" data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                    data-url="{{ $item->url }}" data-target="{{ $item->target }}" data-icon_class="{{ $item->icon_class }}"
                    data-icon_class="{{ $item->icon }}" href="{{ route('menus.updateitem', $item->id) }}">
                    <i class="fas fa-pen"></i> {{ __('Edit') }}
                </div>
            </div>
            <div class="dd-handle">
                @if ($item->icon_class)
                <i class="{{$item->icon_class}}"></i>
                @endif
                <span>{{ $item->title }}</span> <small class="url">{{ $item->link() }}</small>
            </div>
            @if (!$item->children->isEmpty())
                @include('menu.builder', ['items' => $item->children])
            @endif
        </li>
    @endforeach
</ol>
