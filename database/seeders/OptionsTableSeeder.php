<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "app_name" => "WOKOYA Admin",
            "app_description" => "WOKOYA Stater kits and admin generator",
            "app_favicon" => '/uploads/2021/11/favicon.ico',
            "app_logo-abbr" => '/uploads/2021/11/logo.png',
            "app_logo-compact" => '/uploads/2021/11/logo-text.png',
            "app_brand-title" => '/uploads/2021/11/logo-text.png',
            "app_copyright" => "Copyright © <a href='/'>DUCOR</a> 2022",
            //auth
            "auth_disableRegistration" => 1,
            "auth_rememberMe" => 1,
            "auth_forgotPassword" => 1,
            "auth_verifyEmail" => 0,
            "notifications_signup_email" => 0,
        ];

        option($data);
    }

}
