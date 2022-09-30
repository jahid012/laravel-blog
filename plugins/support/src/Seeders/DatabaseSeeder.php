<?php

namespace Wokoya\Support\Seeders;

use App\Facades\Env;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(\Wokoya\Support\Seeders\MenuTableSeeder::class);

        if (env('APP_DEMO')) {
            $this->call(\Wokoya\Support\Seeders\DemoVersionSeeder::class);
        }

        // theme options
        $this->options();

        //AuthorizationSeeder
        $this->call(\Wokoya\Support\Seeders\AuthorizationSeeder::class);

        //PageTableSeeder
        $this->call(\Wokoya\Support\Seeders\PageTableSeeder::class);

        //ThemeOptionTableSeeder
        $this->call(\Wokoya\Support\Seeders\ThemeOptionTableSeeder::class);

        // // update session dirver
        // Env::create([
        //     'SESSION_DRIVER' => 'database',
        //     'APP_DEBUG' => 'true',
        // ]);
    }


    public function options()
    {
        option([
            'title_separate' => '',
            'site_description' => '',
            'seo_title' => '',
            'seo_description' => '',
            'seo_ogimage' => '',
            'site_address' => '',
            'site_email' => ' chat@example.com',
            'site_phone' => '+123 456 7890',
            'site_copyright' => 'Copyright @ wokoya',
            // pages
            'site_herobg' => asset('themes/wokoya/assets/img/header-bg.jpg'),
            'site_logo' => asset('themes/wokoya/assets/img/profile-avatar.jpg'),
            'site_favicon' => '',
            'about_avatar' => asset('themes/wokoya/assets/img/about-me.png'),

            'social_facebook' => '',
            'social_twitter' => '',
            'social_youtube' => '',
            'page_home' => 'home2',
            'page_blog' => 'home1',
        ]);
    }
}
