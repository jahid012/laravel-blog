<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Theme;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Facades\Seo;
use App\Rules\PostSlug;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(30);
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $theme      = Theme::current();
        $locale     = app()->getLocale();

        $languages  = $theme->languages();
        $layouts    = $theme->layouts();

        return view('pages.create', compact('languages', 'layouts', 'locale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|min:5|max:255',
            'slug'      => ['required', 'min:2', 'max:100', 'unique:pages'],
        ]);

        $seo = Seo::create($request->seo);
        Page::create([
            'seo_id'    => $seo->id,
            'locale'    => app()->getLocale(),
            'title'     => $request->title,
            'slug'      => $request->slug,
            'user_id'   => Auth::user()->id,
            'layout'    => "theme::layouts.{$request->layout}",
            'summary'   => $request->summary,
            'content'   => $request->content,
            'thumbnail' => $request->thumbnail,
        ]);

        toastr()->info('"Page Successfully Created."');
        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('pages.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $theme      = Theme::current();
        $languages  = $theme->languages();
        $layouts    = $theme->layouts();

        return view('pages.edit', compact('page', 'languages', 'layouts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'     => 'required|min:2|max:255',
            'slug'      => ['required', 'min:2', 'max:100', new PostSlug('page', true)],
            'layout'    => 'required',
            'status'    => 'required'
        ]);

        $data = $request->except(['_token', '_method']);
        Seo::update($page->id, $request->seo);
        unset($data['seo']);

        // fixed layout
        if(isset($data['layout'])){
            $data['layout'] = "theme::layouts.". $request->layout;
        }

        $page->update($data);

        return redirect()->route('pages.index')->withSuccess("Page Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if($page != null){
            $page->delete();
        }
        return redirect()->route('pages.index')->withSuccess("Page Deleted Successfully.");
    }
}
