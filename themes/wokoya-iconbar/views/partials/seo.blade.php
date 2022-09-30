<!-- Primary Meta Tags -->
<meta name="title" content="{{ $seo->title }}">
<meta name="description" content="{{ $seo->description }}">
<meta name="keywords" content="{{$seo->keywords}}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{$seo->og_type}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:title" content="{{ $seo->og_title }}">
<meta property="og:description" content="{{ $seo->og_description }}">
<meta property="og:image" content="{{ $seo->og_image }}">

<!-- Twitter -->
<meta property="twitter:card" content="{{$seo->twitter_card}}">
<meta property="twitter:url" content="{{url()->current()}}">
<meta property="twitter:title" content="{{ $seo->twitter_title }}">
<meta property="twitter:description" content="{{ $seo->twitter_description }}">
<meta property="twitter:image" content="{{ $seo->twitter_image }}">
