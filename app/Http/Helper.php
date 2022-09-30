<?php

use App\Facades\Theme;
use App\Models\Menu;
use App\Models\ThemeOption;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

if (!function_exists('theme_path')) {
    /**
     * Get the path to the themes folder.
     *
     * @param  string  $path
     * @return string
     */
    function theme_path($path = '')
    {
        return app()->make('path.base') . DIRECTORY_SEPARATOR . 'themes' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (!function_exists('plugin_path')) {
    /**
     * Get the path to the Plugin folder.
     *
     * @param  string  $path
     * @return string
     */
    function plugin_path($path = '')
    {
        return app()->make('path.base') . DIRECTORY_SEPARATOR . 'plugins' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

/**
 *
 */

if (!function_exists('theme')) {
    /**
     *
     * @param  string  $shortname
     * @return Theme
     */
    function theme($shortname = null)
    {
        if ($shortname == null) {
            return Theme::find($shortname);
        }
        return Theme::class;
    }
}


if (!function_exists('__o')) {

    /**
     * Get Theme option value
     *
     * @param  string  $key
     * @return string
     */
    function __o($key, $value = "")
    {
        if (config('cms.theme') == null) {
            return $value;
        }

        $tkey = config('cms.theme') . ".{$key}";

        $value = Cache::rememberForever($tkey, function () use ($key, $value) {
            $data = ThemeOption::where([
                'theme_name' => config('cms.theme'),
                'key'        => $key,
                'lang'       => App::currentLocale(),
            ])->first();

            if ($data == null) {
                return $value;
            }
            return $data->value;
        });
        return  $value;
    }

    /**
     *
     */
    function admin_asset($path)
    {
        return asset("themes/admin/assets/{$path}");
    }

    /**
     *
     */
    function theme_asset($path)
    {
        $dir = Theme::current()->shortname;
        return asset("themes/{$dir}/assets/{$path}");
    }

    if (!function_exists('array_dot')) {
        /**
         * Flatten a multi-dimensional associative array with dots.
         *
         * @param  iterable  $array
         * @param  string  $prepend
         *
         * @return array
         */
        function array_dot(iterable $array, string $prepend = ''): array
        {
            $results = [];

            foreach ($array as $key => $value) {
                if (is_array($value) && !empty($value)) {
                    $results = array_merge($results, array_dot($value, $prepend . $key . '.'));
                } else {
                    $results[$prepend . $key] = $value;
                }
            }

            return $results;
        }
    }

    if (!function_exists('array_undot')) {
        function array_undot($dotNotationArray)
        {
            $array = [];
            foreach ($dotNotationArray as $key => $value) {
                Arr::set($array, $key, $value);
            }

            return $array;
        }
    }


    if (!function_exists('menu')) {
        function menu($menuName, $type = null, array $options = [])
        {
            return Menu::display($menuName, $type, $options);
        }
    }
}

if (!function_exists('toastr')) {
    /**
     * Return the instance of toastr.
     *
     * @return Brian2694\Toastr\Toastr
     */
    function toastr()
    {
        return app('toastr');
    }
}



//alert
if (!function_exists('alert')) {

    /**
     * Helper alert()->info() without facade: Alert::info()
     *
     * @param null        $title
     * @param null        $content
     * @param bool|string $icon
     * @return \Illuminate\Foundation\Application|mixed
     */
    function alert($title = null, $content = null, $icon = true)
    {
        $notifier = app('alert');

        if (!is_null($title)) {
            return $notifier->info($title, $content, $icon);
        }

        return $notifier;
    }
}
