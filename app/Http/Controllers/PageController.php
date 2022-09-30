<?php

namespace App\Http\Controllers;

use App\Facades\ThemeOption;
use App\Http\Middleware\ThemeUseMiddleware;
use App\Models\Page;
use Illuminate\Support\Facades\View;
use Plugins\Blog\Models\Post;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware(ThemeUseMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $page = Page::findOrFail( ThemeOption::get('page_home') );

        return view($page->layout, compact('page'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function any($slug)
    {
        $theme_name = config('cms.theme');

        $page = Page::where('slug', $slug)->first();

        if($page == null || $page->status != 'published'){
            return abort(404);
        }

        if(!view()->exists($page->layout)){
            return abort(404);
        }

        return view($page->layout, compact('page'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sitemap()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        if(!class_exists(Post::class)){
            return abort(404);
        }

        $page = Page::findOrFail( ThemeOption::get('page_blog') );
        $posts = Post::paginate();

        return view($page->layout, compact('page', 'posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post($slug)
    {
        if(!class_exists(Post::class) || !view()->exists('theme::layouts.post') ){
            return abort(404);
        }

        $page = Post::where('slug', $slug)->first();
        if($page == null){
            return abort(404);
        }

        return view('theme::layouts.post', compact('page'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function sitemap()
    // {
    //     //
    // }

}
