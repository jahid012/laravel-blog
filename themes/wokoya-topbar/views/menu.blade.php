@foreach ($items as $item)
<li class="nav-item">
    <a class="nav-link smooth-scroll @if($loop->first) {{' active'}} @endif" href="{{$item->url}}">{{$item->title}}</a>
</li>
@endforeach

