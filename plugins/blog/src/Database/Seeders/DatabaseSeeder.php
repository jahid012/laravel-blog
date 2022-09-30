<?php

namespace Plugins\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Blog\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(\Plugins\Blog\Database\Seeders\CategoriesTableSeeder::class);
        Post::factory(100)->create();

    }
}
