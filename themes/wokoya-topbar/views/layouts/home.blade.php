@extends('theme::layouts.default')

@section('defaultContent')

<main class="main">

    @include('theme::partials.hero')

    @include('theme::partials.about')

    @include('theme::partials.exp-area')

    @include('theme::partials.faq')

    @include('theme::partials.work')

    @include('theme::partials.feedback')

    @include('theme::partials.promo')

    @include('theme::partials.blog')
</main>

@include('theme::partials.footer')

@endsection
