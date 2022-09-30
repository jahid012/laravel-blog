<?php

namespace App\Http\Controllers\Installer;

defined('STDIN') or define('STDIN', fopen("php://stdin", "r"));

use App\Facades\Env;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Facades\Installer as Support;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

/*
 * Address timeout limits
 */

@set_time_limit(3600);
@ini_set('memory_limit', '-1');

/*
 * Prevent PCRE engine from crashing
 */
@ini_set('pcre.recursion_limit', '524'); // 256KB stack. Win32 Apache


class InitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_url = Support::get('app_url');

        // remove installed finish flag
        if (file_exists(storage_path('cms/cms_installed'))) {
            File::delete(storage_path('cms/cms_installed'));
        }

        // create storage link
        if (!file_exists(base_path('uploads'))) {
            Artisan::call('storage:link');
        }

        // assets links
        if (!file_exists(base_path('themes/admin/assets'))) {
            Artisan::call('cms:assets');
        }

        return view('installer.index', compact('app_url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = (string)urldecode($request->input('url'));

        if (Support::get('app_url') == false || Support::get('app_url') == null) {

            Support::set('app_url', $url);

            (new LoadEnvironmentVariables)->bootstrap(app());
            Env::update([
                "APP_URL" => $url,
                'QUEUE_CONNECTION'  => 'sync',
                'SESSION_DRIVER'    => 'file',
                'APP_ENV'           => 'local',
                'APP_DEBUG'         => 'true',
                'APP_DEMO'          => 'false'
            ]);
            sleep(2);
        }

        // ensure emtry database.sqlite
        if (!file_exists($path = database_path('database.sqlite'))) {
            file_put_contents($path, '');
        }

        config([
            'session.driver' => 'file',
            'app.url'        => $url,
        ]);

        return redirect()->route('install.welcome');
    }

    /**
     * Wellcome message
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('installer.welcome');
    }
}
