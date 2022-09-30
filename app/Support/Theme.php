<?php

namespace App\Support;

use App\Facades\ThemeOption;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Facades\Env;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Rinvex\Language\LanguageLoader;
use Symfony\Component\Finder\Finder;

class Theme
{
   /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new cache table command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct($shortname = null)
    {
        $this->shortname = $shortname;
    }

    /**
     * The theme's attributes.
     *
     * @var array
     */
    public $attributes = [];

    /**
     * The Theme "shortname" name is theme direcotry name and
     * its unique.
     *
     * @var
     */
    protected $shortname;

    /**
     *
     * @var Singleton
     */
    public static $instance;

    /**
     * Active theme
     * @return $shortname
     */
    public function active()
    {
        Env::updateOrCreate(['STANDARD_THEME' => $this->shortname]);
        config(['cms.theme' => $this->shortname]);

        $composer = new  Composer(new Filesystem);
        $composer->dumpAutoloads();

        if(class_exists(\Wokoya\Support\Seeders\ThemeOptionTableSeeder::class)){
            Artisan::call('db:seed', [
                '--class' => "Wokoya\\Support\\Seeders\\ThemeOptionTableSeeder"
            ]);
            Artisan::call('db:seed', [
                '--class' => "Wokoya\\Support\\Seeders\\PageTableSeeder"
            ]);
        }

        Artisan::call('view:clear');
        Artisan::call('config:clear');

        return true;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return module
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * return module array
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $collection = collect();
        foreach ($this->optimize() as $data) {
            // create new instance
            self::$instance = new self($data['shortname']);
            self::$instance->attributes = $data;
            $collection->push(self::$instance);
        }

        return $collection->all();
    }

    /**
     *  get all theme data
     *
     * @return instance
     */
    public function get()
    {
        $collection = collect();
        foreach ($this->optimize() as $data) {
            // create new instance
            self::$instance = new self(null);
            self::$instance->attributes = $data;
            self::$instance->shortname = $data['shortname'];
            $collection->push(self::$instance);
        }
        self::$instance = new self();
        self::$instance->attributes = $collection->toArray();
        return self::$instance;
    }

    /**
     * get theme
     *  @param stirng $name
     * @return mix
     */
    public function findOrFail($name)
    {
        self::$instance = new self($name);
        foreach ($this->all() as $data) {
            if ($data->attributes['shortname'] == $name) {
                $this->attributes  = $data->attributes;
                $this->shortname   = $data->attributes['shortname'];
                return $this;
            }
        }
        return abort(404);
    }

    /**
     * get theme
     *  @param stirng $name
     * @return mix
     */
    public function find($name)
    {
        self::$instance = new self($name);
        foreach ($this->all() as $data) {
            if ($data->shortname == $name) {
                $this->attributes = $data->attributes;
                $this->attributes['name'] = $data->shortname;
                $this->shortname = $name;
                return $this;
            }
        }
        return null;
    }

    /**
     * Count number of Attribute.
     *
     * @return int
     */
    public function count()
    {
        return count($this->attributes);
    }

    /**
     * exists the entry.
     * @param string $shortname
     *
     * @return boolean
     */
    public function exists(String $shortname)
    {
        foreach ($this->all() as $name => $data) {
            if ($name == $shortname) {
                return true;
            }
        }
        return false;
    }


    /**
     * Delete the entry.
     * @param string $shortname
     *
     * @return boolean
     */
    public function remove()
    {
        if (is_dir($this->full_path) && $this->enable == false) {
            // delete files
            if (File::deleteDirectory($this->full_path)) {
                // recache Plugin
                $this->optimize();
                return true;
            }
        }
        return false;
    }

    /**
     * Determines if the specified current theme.
     *
     * @return mixed
     */
    public function current()
    {
        foreach ($this->all() as $data) {

            if (Config::get('cms.theme') == $data->shortname) {
                $this->attributes = $data->attributes;
                $this->shortname = $data->attributes['shortname'];
                return $this;
            }
        }

        $this->attributes = [];
        return $this;
    }

    /**
     * Get theme pages
     * @return array
     */
    public function pages($pages = array())
    {
        $base_path = theme_path("{$this->shortname}/views/pages/");

        // get home pages
        $finder = new Finder();
        $finder->files()->in($base_path . 'home')->name('*.blade.php');
        // check if there are any search results
        if ($finder->hasResults()) {
            foreach ($finder->files() as $file) {
                $pages[] = "home." . str_replace(".blade.php", '', $file->getRelativePathname());
            }
        }

        // get all otheres pages
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($base_path)->notPath('home')->name('*.blade.php');

        // check if there are any search results
        if ($finder->hasResults()) {
            foreach ($finder->files() as $file) {
                $pages[] = str_replace(".blade.php", '', $file->getRelativePathname());
            }
        }
        return $pages;
    }

    /**
     * Get current Theme Home path
     * @return string
     */
    public function getHomePath()
    {
        return ThemeOption::get('page_home');
    }

    /**
     * Get Theme Theme languages
     * @return array
     */
    public function languages()
    {
        // get default languages
        $langs = LanguageLoader::language(config('app.locale'), false);
        // fixed error
        if (!is_dir("{$this->full_path}/lang/{$langs['iso_639_1']}")) {
            File::ensureDirectoryExists("{$this->full_path}/lang/{$langs['iso_639_1']}");
        }

        $langs = [$langs['iso_639_1'] => $langs['name']];

        foreach (glob("{$this->full_path}/lang/*",  GLOB_ONLYDIR | GLOB_ERR) as $path) {
            $code           = str_replace("{$this->full_path}/lang/", '', $path);
            $langs[$code]  = LanguageLoader::language($code)->getName();
        }

        return $langs;
    }

    /**
     * Get Theme Theme languages
     * @return array
     */
    public function layouts()
    {
        $paths = [];
        foreach (glob("{$this->full_path}/views/layouts/*.blade.php",  GLOB_ERR) as $path) {

            $code  = str_replace("{$this->full_path}/views/", '', $path);
            $code  = str_replace('.blade.php', '', $code);
            $code  = str_replace('/', '.', $code);
            $code  = "theme::{$code}";
            $value = str_replace('theme::layouts.', '', $code);
            $paths[$code]  = $value;
        }

        return $paths;
    }

    /**
     * get path
     * @return string $path
     */
    public function path($path = "")
    {
        if ($path == "") {
            return $this->full_path . "/";
        }
        return "{$this->full_path}/{$path}";
    }

    /**
     * retuan to array
     *
     * @return array
     */
    public function toArray()
    {
        if (is_array($this->attributes)) {
            foreach ($this->attributes as $key => $value) {
                $this->attributes[$key] = $value->attributes;
            }
            return  $this->attributes;
        }
        return $this;
    }

    /**
     * retuan to array
     *
     * @return json
     */
    public function toJson($pretty = false)
    {
        if ($pretty) {
            return json_encode($this->toArray(), JSON_PRETTY_PRINT);
        }
        return json_encode($this->toArray());
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->attributes['name'];
        // $name = explode('/', $this->attributes['name'] );
        // $name = str_replace('theme', '', end($name));
        // $name = str_replace('-', ' ', $name);
        // $name = str_replace('_', ' ', $name);

        // return $name;
    }

    /**
     * Get name in lower case.
     *
     * @return string
     */
    public function getLowerName(): string
    {
        return strtolower($this->name);
    }

    /**
     * Get name in studly case.
     *
     * @return string
     */
    public  function getStudlyName(): string
    {
        return Str::studly($this->name);
    }

    /**
     * Get name in snake case.
     *
     * @return string
     */
    public function getSnakeName(): string
    {
        return Str::snake($this->name);
    }

    /**
     * Determines if the specified module is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enable;
    }

    /**
     * Determines if the specified module is disabled.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return !$this->enable;
    }

    /**
     * scan all Plugin
     * @param boolean $force
     * @return array
     */
    public function optimize()
    {
        return require base_path('bootstrap/cache/themes.php');
    }

    /**
     *
     * @param string $file theme.json path
     *
     * @return array
     */
    public function packageFromFile($file)
    {
        return json_decode(File::get($file), true);
    }

    /**
     * Get asset path
     *
     * @param string $path
     * @return string $path
     */
    public function asset($path)
    {
        $dir = $this->current()->shortname;
        return asset("themes/{$dir}/assets/{$path}");
    }

    /**
     * get attribute
     * @param attribute $name
     * @return string
     */
    public function __get($name)
    {

        if (isset($this->attributes[$name]) == true) {
            return $this->attributes[$name];
        }
        return "";
    }


}
