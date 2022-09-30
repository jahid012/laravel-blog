<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class ThemeOption extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'theme_name', 'key', 'value', 'lang'
    ];


    /**
     * get theme options
     * @param string|array $keys
     * @param string $value
     * @return string  $value
     */
    public static function get($key, $value = "")
    {
        $data = ThemeOption::where([
            'theme_name' => config('cms.theme'),
            'key'        => $key,
            'lang'       => App::currentLocale(),
        ])->first();

        if($data == null){
            return $value;
        }

        return $data->value;
    }

    /**
     * Set theme options
     * @param string|array $keys
     * @param string $value
     * @return bool
     */
    public static function set($keys, $value = "")
    {
        if(is_array($keys)){
            foreach ($keys as $v) {
                if(isset($v['key']) == true && isset($v['value']) == true ){
                    return self::set($v['key'], $v['value']);
                }
                return false;
            }
        }
        // insert
        $theme_name = config('cms.theme');
        if(is_string($keys) && $theme_name  && $theme_name != ""){

            return self::updateOrCreate([
                'theme_name'    => $theme_name,
                'key'           => $keys,
                'value'         => $value,
                'lang'          => App::currentLocale(),
            ]);
        }else{
            return false;
        }
    }

    /**
     * Set or Fails
     */
    public function createOrFail($keys, $value = "", $theme_name = null)
    {
        if($theme_name == null){
            return false;
        }

        if(is_array($keys)){
            foreach ($keys as $key => $value) {
                if(is_string($key) && (string)$value  ){
                    $this->createOrFail($key, $value,  $theme_name);
                }
            }
        }

        // insert
        if(is_string($keys) ){
            $option = self::firstOrNew([
                'theme_name'=>  $theme_name,
                'key'       => $keys,
                'lang'      => app()->currentLocale()
            ]);
            if (!$option->exists) {
                $option->fill([
                    'value'=> $value,
                ])->save();
            }
            return true;
        }else{
            return false;
        }
    }

}
