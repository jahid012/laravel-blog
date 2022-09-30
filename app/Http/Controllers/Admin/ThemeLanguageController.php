<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Theme::current()->languages();
        return view('themes.languages.index', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request->country_code);
        $theme = Theme::current();
        foreach ($theme->languages() as $key => $value) {
            if($key == $request->country_code){
                return back()->with(['message' => "Language already exist.", 'alert-type' => 'error']);
            }
        }

        File::ensureDirectoryExists($theme->path("lang/{$request->country_code}"));
        return back()->withSuccess("Language Created");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        if($code == app()->getLocale()){
            return back()->with([ 'message' => "Default Langulage You can not delete it.", 'alert-type' => 'error']);
        }
        $theme = Theme::current();
        if(is_dir($theme->path("lang/{$code}"))){
            File::deleteDirectory($theme->path("lang/{$code}"));
        }

        return back()->withSuccess("Language Delete Successfully ");
    }
}
