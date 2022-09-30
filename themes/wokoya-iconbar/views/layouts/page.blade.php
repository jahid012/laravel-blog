@extends('theme::layouts.default')

@section('defaultContent')
    <main class="main">

        <div class="container mx-4 mx-sm-2 px-4 min-vh-100">
            <div class="row">
                <div class="col-12 post-container blog-area pt-5" id="home">
                    <h1>{{$page->title }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col vh-50">
                    <div class="my-3">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="clearfix"></div>
        <!-- Start Footer
             ============================================= -->
        @include('theme::partials.footer')
    </main>
@endsection
