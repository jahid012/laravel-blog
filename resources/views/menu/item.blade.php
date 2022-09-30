<li>
    <a href="{{ $item->url }}" class="ai-icon">
        @if ($item->icon_class)
        <i class="{{$item->icon_class}}"></i>
        @endif
        <span class="nav-text">@lang($item->title)</span>
    </a>
</li>
