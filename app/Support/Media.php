<?php

namespace App\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;

class Media{


    /**
     * The theme's attributes.
     *
     * @var array
     */
    public $attributes = [];

    /**
     * The Theme "path" name is theme direcotry name and
     * its unique.
     *
     * @var
     */
    protected $path;

    /**
     *
     * @var Singleton
     */
    public static $instance;

    /**
     * The constructor.
     */
    public function __construct( $path = null)
    {
        $this->path = $path;
    }

    /**
     * Get current month files or
     * get files by years and month
     *
     * @return array
     */
    public function where($year = null, $month = null)
    {
        if($year == null){
            $year = date("Y");
        }
        if($month == null){
            $month = date("m");
        }
        $dir = $year . DIRECTORY_SEPARATOR . $month;

        $files = [];
        foreach (Storage::disk('public')->files($dir) as $path) {

            $pathinfo = pathinfo(storage_path("app/public/{$path}"));
            $pathinfo['path']           =  $path;
            // $pathinfo['full_path']      =  storage_path("app/public/{$path}");
            $pathinfo['url']            =  url("uploads/{$path}");
            $pathinfo['relative_url']   =  "uploads/{$path}";
            $pathinfo['year']           =  $year;
            $pathinfo['month']          =  $month;
            unset($pathinfo['dirname']);

            // create new instance
            self::$instance             = new self( null );
            self::$instance->attributes = $pathinfo;
            self::$instance->path       = $path;
            $files[]                    = self::$instance;
        }

        // order by des by key
        $sortArray = [];

        $counter = count($files)-1;
        foreach($files as $file){
            $sortArray[] = $files[$counter];
            $counter--;
        }
        $this->attributes = $sortArray;
        return $this;
    }

    /**
     * Get all items
     */
    public function get()
    {
        return $this->attributes;
    }

    /**
     * Find file by path name
     */
    public function find(string $path)
    {
        if (!Storage::disk('public')->exists($path )) {
            return null;
        }

        $f = explode('/', $path);
        $file = Storage::disk('public')->path($path);
        $pathinfo                   = pathinfo($file);
        $pathinfo['url']            =  url("uploads/{$path}");
        $pathinfo['relative_url']   =  "uploads/{$path}";
        $pathinfo['year']           =  $f[0];
        $pathinfo['month']          =  $f[1];
        unset($pathinfo['dirname']);

        $this->attributes           = $pathinfo;
        $this->path                 = $path;

        return $this;
    }
    /**
     * Delete file
     * @return bool
     */
    public function delete():bool
    {
        if (!Storage::disk('public')->exists($this->path )) {
            return false;
        }

        return Storage::disk('public')->delete($this->path);
    }

    /**
     * Upload files
     * @param $files
     * @return bool|mix
     */
    public function uploads($files)
    {
        if(is_array($files)){
            foreach ($files as $file) {
                return $this->uploads($file);
            }
        }

        if($files != null){
            return $files->move(
                $this->ensurePath(),
                date('dhis').'-'. uniqid() .'.'.$files->getClientOriginalExtension()
            );
        }

        return false;
    }

    /**
     * ensure current path
     */
    public function ensurePath()
    {
        $year = date("Y");
        $month = date("m");
        $dir_path = base_path("storage/app/public/{$year}/{$month}");
        File::ensureDirectoryExists($dir_path);
        return $dir_path;
    }

    /**
     * Get Year Directories
     * @return array
     */
    public static function directories()
    {
        $root = config('filesystems.disks.public.root'). '/';
        $name =[];
        foreach (glob($root. '*', GLOB_ONLYDIR) as $path) {

            $year = (int)str_replace($root, '', $path);
            if($year > 2010 && $year <= (int) date('Y')){
                $name[] = (string)$year;
            }
        }
        krsort( $name );
        return $name;
    }

    /**
     * Get years directories
     * @param int $year
     * @return array
     */
    public static function yearsDirectories(int $year)
    {
        $dirs =  Storage::disk('public')->directories((string) $year);
        $name = [];
        foreach ($dirs as $path) {
            array_push($name, $path);
            $month = explode('/', $path);
            switch (end($month)) {
                case '01':
                    $name[$path] = "{$year} January";
                    break;
                case '02':
                    $name[$path] = "{$year} February";
                    break;
                case '03':
                    $name[$path] = "{$year} March";
                    break;
                case '04':
                    $name[$path] = "{$year} April";
                    break;
                case '05':
                    $name[$path] = "{$year} May";
                    break;
                case '06':
                    $name[$path] = "{$year} June";
                    break;
                case '07':
                    $name[$path] = "{$year} July";
                    break;
                case '08':
                    $name[$path] = "{$year} August";
                    break;
                case '09':
                    $name[$path] = "{$year} September";
                    break;
                case '10':
                    $name[$path] = "{$year} October";
                    break;
                case '11':
                    $name[$path] = "{$year} November";
                    break;
                case '12':
                    $name[$path] = "{$year} December";
                    break;
                default:
                    break;
            }
        }
        return $name;
    }

    /**
     * Get all directories with moth
     * @return array
     */
    public static function allDirectories()
    {
        $root = config('filesystems.disks.public.root'). '/';
        $name =[];
        foreach (glob($root. '**/**/*.*') as $path) {

            // ignore directories
            if(is_dir($path)){
                continue;
            }

            $path = str_replace($root, '', $path);
            // ignore first diretory only
            if(!strpos($path, '/')){
                continue;
            }

            $paths = explode('/', $path, 3);
            $year = (int)$paths[0];
            // igonre first path directory
            if($year < 2010 && $year <= (int)date('Y') ){
                continue;
            }

            $path = "{$year}/{$paths[1]}";
            switch ($paths[1]) {
                case '01':
                    $name[$path] = "{$year} January";
                    break;
                case '02':
                    $name[$path] = "{$year} February";
                    break;
                case '03':
                    $name[$path] = "{$year} March";
                    break;
                case '04':
                    $name[$path] = "{$year} April";
                    break;
                case '05':
                    $name[$path] = "{$year} May";
                    break;
                case '06':
                    $name[$path] = "{$year} June";
                    break;
                case '07':
                    $name[$path] = "{$year} July";
                    break;
                case '08':
                    $name[$path] = "{$year} August";
                    break;
                case '09':
                    $name[$path] = "{$year} September";
                    break;
                case '10':
                    $name[$path] = "{$year} October";
                    break;
                case '11':
                    $name[$path] = "{$year} November";
                    break;
                case '12':
                    $name[$path] = "{$year} December";
                    break;
                default:
                    break;
            }
        }
        return $name;
    }

    /**
     * To Array
     */
    public function toAttay()
    {
        if (is_array($this->attributes)) {
            foreach ($this->attributes as $key => $value) {
                $this->attributes[$key] = $value->attributes;
            }
            return  $this->attributes;
        }

        return [];
    }

    public function basename()
    {
        return $this->basename;
    }

    public function extension()
    {
        return $this->extension;
    }


    public function filename()
    {
        return $this->filename;
    }


    public function path()
    {
        return $this->path;
    }

    public function url()
    {
        return $this->url;
    }

    public function relative_url()
    {
        return $this->relative_url;
    }

    public function absulate()
    {
        return $this->path;
    }


    /**
     * get attribute
     * @param attribute $name
     * @return string|mix
     */
    public function __get ( $name ){

        if(isset($this->attributes[$name]) == true){
            return $this->attributes[$name];
        }
        return "";
    }

}

?>
