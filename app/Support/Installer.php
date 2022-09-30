<?php

namespace App\Support;

defined('STDIN') or define('STDIN', fopen("php://stdin", "r"));

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Facades\Installer as Support;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class Installer
{

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    public $files;

    /**
     * The tem file path path.
     *
     * @var string
     */
    public $db_path;

    /**
     * The loaded temp data array.
     *
     * @var array
     */
    public $db = [];

    /**
     * Create a new package installer db.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $db_path
     * @param  string  $db
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->db_path = storage_path('cms/installer.json');

        if (empty($this->db)) {
            $this->init(false);
        }
    }

    /**
     * Initialize installer
     *
     * @param boolean $force
     * @return void
     */
    public function init($force = true)
    {
        if ($force || !$this->files->exists($this->db_path)) {

            Artisan::call('optimize:clear');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');

            // create directories
            $this->files->ensureDirectoryExists(
                storage_path('cms')
            );

            $this->db = $this->defaultContent();
            $this->save();
        } else {
            $data =  $this->files->get($this->db_path, false);
            $this->db = json_decode($data, true);
        }
    }


    /**
     * Set Default Content
     */
    public function defaultContent()
    {
        return [
            'id' => Str::uuid()->toString(),
            'start' => false,
            'checkPermissions' => false,
            'checkRequirements' => false,
            'db' => [],
            'app_url' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'finished_at' => false,
        ];
    }

    /**
     * Set data
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function set($key, $value)
    {
        if (isset($this->db[$key]) == true || isset($this->db[$key]) === true || $this->db[$key] == null) {
            $this->db[$key] = $value;
            $this->save();
        }
        return true;
    }

    /**
     * Get data
     * @param string $key
     * @param mixed $default
     * @return self
     */
    public function get($key, $default = null)
    {
        if (isset($this->db[$key]) == true) {
            $default = $this->db[$key];
        }
        return $default;
    }

    /**
     * Save Data
     * @return void
     */
    public function save()
    {
        $data = json_encode($this->db, JSON_PRETTY_PRINT);
        $data = str_replace('\/', '/', $data);
        $this->files->put($this->db_path, $data);
    }

    /** ======================================================= */
    /**
     * get site url
     * so assets url is different
     * @return string
     */
    public static function get_site_url($path = "")
    {
        $url = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))) . '://';
        $url .= request()->getHttpHost();

        // fixed and get path
        $s_path =  explode('/index.php/', $_SERVER['PHP_SELF']);
        $s_path[0] != "" ? $url .= $s_path[0] : "";

        // has path
        if ($path != "") {
            $url .= $path;
        }
        $url = Str::of($url)->rtrim('/');
        $url =  str_replace('/index.php', '', (string)$url);

        // fixed ssl issue
        $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']  === 'on' ? "https://" : "http://");
        $url = str_replace('http://', $http, $url);
        $url = str_replace('https://', $http, $url);

        return $url;
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    public static function generateRandomKey()
    {
        return 'base64:' . base64_encode(
            Encrypter::generateKey(config('app.cipher'))
        );
    }

    /**
     * Update ortions
     *
     * @return void
     */
    public static function getOptions()
    {
        return [
            "app_name" => "Wokoya Laravel CMS",
            "app_description" => "",
            "app_favicon" => self::get_site_url('/uploads/2021/11/favicon.ico'),
            "app_logo-abbr" => self::get_site_url('/uploads/2021/11/logo.png'),
            "app_logo-compact" => self::get_site_url('/uploads/2021/11/logo-text.png'),
            "app_brand-title" => self::get_site_url('/uploads/2021/11/logo-text.png'),
            "app_copyright" => "Copyright © <a href='/'>DUCOR</a> 2021",
            //auth
            "auth_disableRegistration" => 0,
            "auth_rememberMe" => 1,
            "auth_forgotPassword" => 1,
            "auth_verifyEmail" => 0,
            "notifications_signup_email" => 0,
        ];
    }

    /**
     * @return array
     */
    public static function getRequirements()
    {
        $error = false;
        // version
        $requirements = [
            "PHP Version (>=" . config('installer.core.minPhpVersion') . ")" => version_compare(phpversion(), config('installer.core.minPhpVersion'), '>='),
        ];

        foreach (config('installer.requirements.php') as $extension) {
            $requirements[$extension . ' Extension'] = extension_loaded($extension);
        }

        // set error flag
        foreach ($requirements as $key => $value) {
            if ($value == false) {
                $error = true;
                break;
            }
        }

        return ['requirements' => $requirements, 'error' => $error];
    }

    /**
     * @return array
     */
    public static function getPermissions(): array
    {
        $data = array('permissions' => [], 'error' => false);

        foreach (config('installer.permissions') as $key => $permission) {
            if (is_dir($key)) {
                $current_permission         = substr(sprintf('%o', fileperms(base_path($key))), -4);
                $data['permissions'][$key] = array(
                    'key'                   => $key,
                    'target_permission'     => $permission,
                    'current_permission'    => (int)substr(sprintf('%o', fileperms(base_path($key))), -4),
                    'error'                 => $permission != $current_permission ? true : false,
                    'type'                  => 'dir',
                );
            } elseif (file_exists($key)) {
                $current_permission         = substr(sprintf('%o', fileperms(base_path($key))), -4);
                $data['permissions'][$key] = array(
                    'key'                   => $key,
                    'target_permission'     => $permission,
                    'current_permission'    => (int)substr(sprintf('%o', fileperms(base_path($key))), -4),
                    'error'                 => $permission != $current_permission ? true : false,
                    'type'                  => 'file',
                );
            }

            // set errors
            if ($data['error'] == false) {
                $data['error'] = $permission != $current_permission ? true : false;
            }
        }
        return $data;
    }

    /**
     * Handle database connection
     * DBconnection
     * @return bool
     */
    public static function tryDBconnect(): bool
    {
        $db = Support::get('db');

        if (!is_array($db) || is_array($db) && empty($db)) {
            return false;
        }

        if ($db['DB_CONNECTION'] == 'sqlite') {
            config([
                "database.default"  => 'sqlite',
                "database.connections.sqlite.foreign_key_constraints" => true,
            ]);
        } elseif ($db['DB_CONNECTION'] == 'mysql') {
            config([
                "database.default"                    => 'mysql',
                "database.connections.mysql.host"     => $db['DB_HOST'],
                "database.connections.mysql.port"     => $db['DB_PORT'],
                "database.connections.mysql.database" => $db['DB_DATABASE'],
                "database.connections.mysql.username" => $db['DB_USERNAME'],
                "database.connections.mysql.password" => $db['DB_PASSWORD'],
            ]);
        }

        try {
            DB::purge($db['DB_CONNECTION']);
            DB::purge();
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * fixed usl
     */
    public static function fixedUrl($url = null)
    {
        if ($url) {
            config([
                'session.driver' => 'file',
                'app.url'        => $url,
            ]);
        } else {
            config([
                'session.driver' => 'file',
                'app.url'        => Support::get('app_url'),
            ]);
        }
    }
}
