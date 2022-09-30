
<ul class="metismenu mm-show" id="menu">
    <li class="nav-label first"> @lang('Main Menu')</li>
    @foreach ($items as $item)
        @if($item->children()->count())
            @include('menu.children', ['item' => $item ])
        @else
            @include('menu.item', ['item' => $item ])
        @endif
    @endforeach
</ul>
