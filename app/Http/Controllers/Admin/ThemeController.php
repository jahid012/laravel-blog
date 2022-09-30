<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Http\Request;
use App\Facades\Theme;
use App\Facades\ThemeOption;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

class ThemeController extends Controller
{
    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new cache table command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    /**
     * @see \App\Support\ThemeOption
     */
    protected $theme;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        // $this->theme = Theme::current();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('theme.viewAny');
        $themes = Theme::all();

        return view('themes.index', \compact('themes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $this->authorize('theme.update');
        $shortname  = urldecode($request->shortname);
        $theme      = Theme::findOrFail($shortname);

        (new LoadEnvironmentVariables)->bootstrap(app());
        $theme->active();
        sleep(2);

        return redirect()->route('themes.index')->with(['message' => "'{$shortname}' Theme Enabled", 'alert-type' => 'success']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function options(Request $request)
    {
        $this->authorize('theme.update');
        $content = "";
        $pages = Page::select(['id', 'title', 'slug'])->get();

        if(View::exists("theme::options")){
            $content = View::make("theme::options", compact('pages'))->render();
        }
        return view('themes.options', compact( 'content' ) );
    }

    /**
     * Update page options
     * @return back()
     */
    public function update_options(Request $request)
    {
        $this->authorize('theme.update');
        $shortname = config('cms.theme');

        foreach ($request->except(['_token', '_method']) as $key => $value) {

            // if(Cache::get("{$theme_name}.{$key}") == $value){
            //     continue;
            // }

            if($value == null){
                continue;
            }

            ThemeOption::updateOrCreate([
                'theme_name'    => $shortname,
                'key'           => $key,
                'lang'          => App::currentLocale(),
            ],[
                'value'         => $value,
            ]);
        }

        return back()->with(["message" => 'The Theme options update complete.', 'alert-type' => 'success']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function languages(Request $request)
    {
        $this->authorize('theme.update');
        $languages = Theme::current()->languages();

        return view('themes.languages', compact( 'languages' ) );
    }

    /**
     * Update theme languages
     * @param Request $request
     * @return back()
     */
    public function update_languages(Request $request)
    {
        $this->authorize('theme.update');
        $shortname = config('cms.theme');

        foreach ($request->except(['_token', '_method']) as $key => $value) {

            // if(Cache::get("{$theme_name}.{$key}") == $value){
            //     continue;
            // }

            if($value == null){
                continue;
            }

            ThemeOption::updateOrCreate([
                'theme_name'    => $shortname,
                'key'           => $key,
                'lang'          => App::currentLocale(),
            ],[
                'value'         => $value,
            ]);
        }

        return back()->with(['message' => "The Theme Enabled", 'alert-type' => 'success']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function translate(Request $request)
    {
        if($request->input('country_code') == null){
            return redirect()->route('themes.languages.index');
        }

        $this->authorize('theme.update');
        // get all languages
        $country_code       = $request->input('country_code');
        $group              = $request->input('group');

        // lang files
        $lang_file_names    = [];
        $lagn_path          = Theme::current()->path("lang/". App::getLocale() . "/");
        $langs              = [];

        if(is_dir( $lagn_path )){
            foreach (glob("{$lagn_path}*.php") as $file_path) {
                $name               = str_replace($lagn_path, '', $file_path);
                $lang_file_names[]  = str_replace('.php', '', $name);
            }
        }

        //target language
        if( is_string($group) && strlen($group)){
            $langs = Lang::get("theme::{$group}");
            if(is_string($langs)){
                $langs = [];
            }
            if( is_array($langs) && !empty($langs)){
                $langs = array_dot($langs);
            }
        }

        return view('themes.translate', compact(['lang_file_names', 'country_code', 'langs', 'group']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function languages_update(Request $request, Filesystem $filesystem)
    {
        $this->authorize('theme.update');
        $request->validate([
            'values'        => 'required|array',
            'keys'          => 'required|array',
            'group'         => 'required|string',
            'country_code'  => 'required|string|min:2|max:2',
        ]);

        // request input
        $values             = $request->input('values');
        $keys               = $request->input('keys');
        $group              = $request->input('group');
        $country_code       = $request->input('country_code');

        foreach ($keys as $index => $key) {
            $values[$key]   = $values[$index];
            unset($values[$index]);
        }
        $values = array_undot($values);

        $path   = Theme::current()->path("lang/{$country_code}");
        if( !is_dir($path )){
            File::ensureDirectoryExists($path);
        }

        File::put(
            "{$path}/{$group}.php",
            '<?php return '.var_export($values, true).';'.PHP_EOL
        );

        return back()->with(['message' => "Theme Langulage File Update Complete", 'alert-type' => 'success']);
    }
}
