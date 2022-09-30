<?php

namespace App\Support;

use App\Facades\ThemeOption;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Menu {

    /**
     * The Theme class init
     *
     */
    public bool $init = true;

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
     * The constructor.
     */
    public function __construct( $shortname = null)
    {
        $this->shortname = $shortname;
        // $data                   = Cache::get('theme.current');
        // if(is_array($data)){
        //     $this->attributes   = $data;
        //     $this->shortname    = $data['shortname'];
        // }
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
            self::$instance = new self( $data['shortname'] );
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
            self::$instance = new self( null );
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
        self::$instance = new self( $name );
        foreach ($this->all() as $data ) {
           if( $data->attributes['shortname'] == $name ){
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
        self::$instance = new self( $name );
        foreach ($this->all() as $data ) {
           if( $data->shortname == $name ){
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
        foreach ($this->all() as $name => $data ) {
           if($name == $shortname){
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
           if(File::deleteDirectory( $this->full_path )){
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
     * @return bool
     */
    public function current()
    {
        $data = Cache::get('theme.current');

        if(is_array($data)){
            $this->attributes = $data;
            $this->shortname = $data['shortname'];
            return $this;
        }

        foreach ( $this->all() as $data ) {

            if( config('cms.theme') == $data->shortname ){
                $this->attributes = $data->attributes;
                $this->shortname = $data->attributes['shortname'];
                Cache::forever('theme.current', $data->attributes);
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
            foreach ( $finder->files() as $file ) {
                $pages[] = "home.". str_replace(".blade.php", '', $file->getRelativePathname());
            }
        }

        // get all otheres pages
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($base_path)->notPath('home')->name('*.blade.php');

        // check if there are any search results
        if ($finder->hasResults()) {
            foreach ( $finder->files() as $file ) {
                $pages[] = str_replace(".blade.php", '', $file->getRelativePathname());
            }
        }
        return $pages;
    }

    /**
     * Get Theme Theme languages
     * @return array
     */
    public function languages()
    {
        // fixed error
        if(!is_dir("{$this->full_path}/lang/")){
            File::ensureDirectoryExists("{$this->full_path}/lang/en");
        }

        $langs = [];
        foreach (glob("{$this->full_path}/lang/*",  GLOB_ONLYDIR|GLOB_ERR) as $path) {
            $code           = str_replace( "{$this->full_path}/lang/", '', $path);
            $langs [$code]  = LanguageLoader::language($code)->getName();
        }
        return $langs;
    }

    /**
     * get path
     * @return string $path
     */
    public function path($path = "")
    {
        if($path == ""){
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
        if($pretty){
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
        $name = explode('/', $this->attributes['name'] );
        $name = str_replace('theme', '', end($name));
        $name = str_replace('-', ' ', $name);
        $name = str_replace('_', ' ', $name);

        return $name;
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
        $themes = [];
        $count = 1;
        foreach ($this->filesToScan() as $file) {
            // default attrubute
            $content    = $this->packageFromFile($file);
            $full_path  = str_replace("/theme.json", '', $file);
            $shortname       = str_replace(theme_path("/"), '', $full_path);

            $themes[$count] = [
                'name' => $content['name'],
                'description' => $content['description'],
                'version' => $content['version'],
                'author_name' => $content['author_name'],
                'author_email' => $content['author_email'],
                'homepage' => $content['homepage'],
                "shortname" => $shortname,
                "full_path" => $full_path,
                'enable' => false,
            ];

            // add enable flag
            if( $themes[$count]['shortname'] == config('cms.theme') ){
                $themes[$count]['enable'] = true;
                $themes[0] = $themes[$count];

                unset($themes[$count]);
                $count --;
            }
            $count ++;
        }
        ksort($themes);

        return $themes;
    }

    /**
     *
     * @return array
     */
    private function filesToScan()
    {
        $paths = [];
        foreach (glob(theme_path('/*/theme.json')) as $filename) {
            if(Str::contains($filename, '/admin/assets')){
                continue;
            }
            $paths[]= $filename;
        }
        return $paths;
    }

    /**
     *
     * @param string $file theme.json path
     *
     * @return array
     */
    public function packageFromFile($file)
    {
        return json_decode(File::get( $file), true);
    }


    /**
     * get attribute
     * @param attribute $name
     * @return string
     */
    public function __get ( $name ){

        if(isset($this->attributes[$name]) == true){
            return $this->attributes[$name];
        }
        return "";
    }

}
