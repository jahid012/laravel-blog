@foreach ($items as $item)
<li class="nav-item">
    <a class="nav-link smooth-scroll" href="{{$item->url}}">
        <i class="{{$item->icon_class}}"></i>
        <span class="toltip"> {{$item->title}}</span>
    </a>
</li>
@endforeach
