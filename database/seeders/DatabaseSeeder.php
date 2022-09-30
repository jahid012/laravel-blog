<?php

namespace Database\Seeders;

use App\Facades\Env;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OptionsTableSeeder::class);
        $this->call(AuthorizationSeeder::class);
        $this->call(MenusTableSeeder::class);
        // theme support
        $this->call(\Wokoya\Support\Seeders\DatabaseSeeder::class);

        // fixed links
        Artisan::call('storage:link', ['--force' => true]);
        Artisan::call('cms:assets', ['--force' => true]);
    }
}
