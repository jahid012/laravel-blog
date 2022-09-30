@extends('layouts.app')

@section('page_title', __('Media Manager'))

@section('page')

<div data-media data-media-title="Media" data-media-inline="true" data-media-actions='["rename","delete","create"]' data-media-can_choose="false"></div>
@endsection
