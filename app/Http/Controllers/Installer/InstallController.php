<?php


namespace App\Http\Controllers\Installer;

defined('STDIN') or define('STDIN', fopen("php://stdin", "r"));

use Illuminate\Support\Facades\DB;
use App\Rules\DBCheckConnection;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Support\Installer;
use App\Facades\Installer as Support;
use App\Facades\Env;

/*
 * Address timeout limits
 */

@set_time_limit(3600);
@ini_set('memory_limit', '-1');

/*
 * Prevent PCRE engine from crashing
 */
@ini_set('pcre.recursion_limit', '524'); // 256KB stack. Win32 Apache


class InstallController extends Controller
{
    /**
     * Step 0
     * Display the permissions check page.
     * @return \Illuminate\Http\Response
     */
    public function check_env()
    {
        // set default value
        $app_url = Support::get('app_url');
        if ($app_url == null || $app_url == false) {
            Support::init(false);
        }

        $uuid = Support::get('id');

        return view('installer.check_env', compact('uuid'));
    }

    // init installer
    public function init(Request $request)
    {
        if (Support::get('id') != $request->input('installer_id')) {
            return back()->with('message', 'Input is not valied!.');
        }
        Support::set('start', true);
        return redirect()->route('install.permissions');
    }

    /**
     * verify licence key
     */

    /**
     * Step 1
     * Display the permissions check page.
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        if (Support::get('start') == false) {
            return redirect()->route('install.welcome');
        }
        // get permission data
        $data    = Installer::getPermissions();

        if ($data['error'] == false) {
            Support::set('checkPermissions', true);
        }

        return view('installer.permissions', compact('data'));
    }

    /**
     * Step 2
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function requirements()
    {
        // check permission
        if (!Support::get('checkPermissions')) {
            return redirect()->route('install.permissions');
        }

        $data = Installer::getRequirements();

        if ($data['error'] == false) {
            Env::update([
                'APP_ENV'           => 'local',
                'APP_DEBUG'         => 'false',
            ]);

            Support::set('checkRequirements', true);
        }

        return view('installer.requirements', compact('data'));
    }

    /**
     * Step 3
     * Show database information form
     * @return \Illuminate\Http\Response
     */
    public function databaseInfoForm()
    {
        // database information emtry
        Support::set('db', []);

        // check permission
        if (Support::get('checkPermissions') == false) {
            return redirect()->route('install.permissions');
        }

        // check requirements
        if (!Support::get('checkRequirements')) {
            return redirect()->route('install.requirements');
        }

        return view('installer.database');
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function databaseInfo(Request $request)
    {
        // check permission
        if (!Support::get('checkPermissions')) {
            return redirect()->route('install.permissions');
        }

        // check requirements
        if (!Support::get('checkRequirements')) {
            return redirect()->route('install.requirements');
        }

        // connection validataion
        $request->validate([
            'DB_CONNECTION'   => ['in:mysql,sqlite', new DBCheckConnection],
        ]);

        Support::set('db', $request->all());

        // remove database keys
        Env::destroy([
            'DB_HOST',
            'DB_PORT',
            'DB_DATABASE',
            'DB_USERNAME',
            'DB_PASSWORD',
            'DB_CONNECTION',
            'DB_FOREIGN_KEYS',
        ]);

        if ($request->DB_CONNECTION == 'mysql') {
            Env::create([
                "DB_CONNECTION" => $request->DB_CONNECTION,
                "DB_HOST"       => $request->DB_HOST,
                "DB_PORT"       => $request->DB_PORT,
                "DB_DATABASE"   => $request->DB_DATABASE,
                "DB_USERNAME"   => $request->DB_USERNAME,
                "DB_PASSWORD"   => $request->DB_PASSWORD,
            ]);
        } elseif ($request->DB_CONNECTION == 'sqlite') {
            Env::create([
                "DB_CONNECTION"    => 'sqlite',
                "DB_FOREIGN_KEYS"  => 'true'
            ]);
        }

        return redirect()->route('install.installationShowForm');
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @return \Illuminate\Http\Response
     */
    public function installationShowForm()
    {
        if (!Installer::tryDBconnect()) {
            return redirect()->route('install.databaseInfoForm')
                ->withErrors(['DB_CONNECTION' => trans('installer_messages.database.error.connection')]);
        }

        // check database table
        $avalableTb = 0;
        if (config("database.default") == 'sqlite') {
            try {
                $avalableTb = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
            } catch (\Throwable $th) {
            }
        } else {
            try {
                $avalableTb = DB::select('SHOW TABLES');
            } catch (\Throwable $th) {
            };
        }

        $db = Support::get('db');

        $table_name = $db['DB_DATABASE'];
        if ($avalableTb) {

            $table_name = $db['DB_DATABASE'];
            if ($db['DB_CONNECTION'] == 'sqlite') {
                $table_name = 'database/database.sqlite';
            }
            return back()->withErrors([
                'DB_CONNECTION' => trans(
                    'installer_messages.database.error.table_not_empty',
                    ['name' => $table_name]
                )
            ]);
        }

        return view('installer.installation', compact('avalableTb', 'table_name'));
    }

    /**
     * Migration and seeding .
     * post method
     *
     * @return Redirector $redirect
     */
    public function installation()
    {
        if (!Installer::tryDBconnect()) {
            return redirect()->route('install.requirements')
                ->withErrors(['database_connection' => trans('installer_messages.database.error.connection')]);
        }
        try {
            //migrate and seed...
            $count = 0;
            if (config('database.default') == 'sqlite') {

                try {
                    $count = count(DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;"));
                } catch (\Throwable $th) {
                }
            } else {
                $count = count(DB::select('SHOW TABLES'));
            }

            if ($count) {
                Artisan::call('migrate:fresh', ['--force' => true]);
            } else {
                Artisan::call('migrate', ['--force' => true]);
            }
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->route('install.fails');
        }

        // seed
        try {
            Artisan::call('db:seed');
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->route('install.fails');
        }

        sleep(1);
        return redirect()->route('install.admin');
    }

    /**
     * Update installed file and display finished view.
     *
     * @return \Illuminate\Http\Response
     */
    public function finish(Request $request)
    {
        // check installed finish flag
        if (file_exists(storage_path('cms/cms_installed'))) {
            return abort(404);
        }

        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return redirect()->route('install.requirements')
                ->withErrors(['database_connection' => trans('installer_messages.database.error.connection')]);
        }

        if (User::first() == null) {
            return redirect()->route('install.admin')
                ->withErrors([
                    'create_user_account' => trans('installer_messages.admin.error.create_user_account'),
                ]);
        }

        (new LoadEnvironmentVariables)->bootstrap(app());
        // setup .env
        //key and value Must be string
        Env::update([
            'APP_INSTALLED'     => 'true',
            'APP_ENV'           => 'local',
            'APP_DEBUG'         => 'false',
            "SESSION_DRIVER"    => "database",
            "MAIL_MAILER"       => "log"
        ]);
        // set default options or setting
        option(Installer::getOptions());

        $user = User::orderBy('updated_at', 'DESC')->first();

        // clear log and installed finish flag
        file_put_contents(storage_path('cms/cms_installed'), (string)date('Y-m-d H:i:s'));
        file_put_contents(storage_path('logs/laravel.log'), '');
        Log::info("cms_installed");
        Support::set('finished_at', (string)date('Y-m-d H:i:s'));
        sleep(3);

        return view('installer.finished', compact('user'));
    }

    /**
     * Update installed file and display finished view.
     *
     * @return \Illuminate\Http\Response
     */
    public function fails()
    {
        return view('installer.error');
    }
}
