<li class="mega-menu mega-menu-lg">
    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="{{$item->icon_class }}"></i>
        <span class="nav-text">{{$item->title }}</span>
    </a>
    <ul aria-expanded="false" class="mm-collapse">
        @foreach ($item->children as $chItem)
        <li><a href="{{$chItem->url}}">{{$chItem->title}}</a></li>
        @endforeach
    </ul>
</li>
