<?php

namespace App\Observers;

use App\Models\ThemeOption;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    /**
     * Handle the ThemeOption "created" event.
     *
     * @param  \App\Models\ThemeOption  $themeOption
     * @return void
     */
    public function created(ThemeOption $themeOption)
    {
        Cache::forever("{$themeOption->theme_name}.{$themeOption->key}", $themeOption->value);
    }

    /**
     * Handle the ThemeOption "updated" event.
     *
     * @param  \App\Models\ThemeOption  $themeOption
     * @return void
     */
    public function updated(ThemeOption $themeOption)
    {
        if(Cache::get("{$themeOption->theme_name}.{$themeOption->key}") != $themeOption->value){
            Cache::forever("{$themeOption->theme_name}.{$themeOption->key}", $themeOption->value);
        }
    }

    /**
     * Handle the ThemeOption "deleted" event.
     *
     * @param  \App\Models\ThemeOption  $themeOption
     * @return void
     */
    public function deleted(ThemeOption $themeOption)
    {
        Cache::forget("{$themeOption->theme_name}.{$themeOption->key}");
    }

}
