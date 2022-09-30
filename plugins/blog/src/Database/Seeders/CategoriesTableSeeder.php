<?php

namespace Plugins\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Blog\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $category = Category::firstOrNew([
            'name'   => __('Uncategorized'),
        ]);
        if (!$category->exists) {
            $category->save();
        }

    }
}
