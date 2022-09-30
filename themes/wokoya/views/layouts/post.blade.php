@extends('theme::layouts.default')

@section('defaultContent')
    <main class="main">

        <div class="container mx-4 mx-sm-2 px-4  min-vh-100">
            <div class="row">
                <div class="col-12 post-container blog-area pt-5" id="home">
                    <a href="{{ route('blog') }}" class="link-blog">
                        <i class="fas fa-long-arrow-alt-left"></i> {{ __('Back to Blog') }}
                    </a>
                    <div class="meta d-inline-block">
                        <span>
                            <i class="icofont-ui-user"></i> {{ $page->auth->getFullName() }}
                        </span>
                        <span class="date">
                            <i class="icofont-calendar"></i> {{ $page->created_at->format('d M, y ') }}
                        </span><span>
                            <i class="icofont-location-arrow"></i> {{ $page->category->name }}
                        </span>
                        @if ($page->tags)
                            <span>
                                <i class="icofont-ui-tag"></i> {{ $page->tags }}
                            </span>
                        @endif

                    </div>
                    <div class="my-5">
                        @if ($page->featured_image)
                            <img src="{{ $page->featured_image }}" class="img-fluid" alt="{{ $page->title }} Post">
                        @endif
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col vh-50">
                    <h1>{{$page->title }}</h1>
                    {!! $page->content !!}
                </div>
            </div>
            <!-- begin comments -->

            @include('theme::partials.disqus_comments')
            {{-- comment --}}
        </div>

        <div class="clearfix"></div>
        <!-- Start Footer
             ============================================= -->
        @include('theme::partials.footer')
    </main>
@endsection
