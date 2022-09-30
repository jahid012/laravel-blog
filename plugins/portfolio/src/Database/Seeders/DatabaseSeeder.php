<?php

namespace Plugins\Portfolio\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Portfolio\Models\Portfolio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data() as $price) {
            Portfolio::updateOrCreate([
                'image'   => $price['image'],
                'category'=> $price['category'],
                'title'   => $price['title'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'image' => asset('themes/wokoya/assets/img/portfolio/1.jpg'),
                'category' => 'Category',
                'title' => 'Project Title',
            ],
            [
                'image' => asset('themes/wokoya/assets/img/portfolio/2.jpg'),
                'category' => 'Category',
                'title' => 'Project Title',
            ],
            [
                'image' => asset('themes/wokoya/assets/img/portfolio/3.jpg'),
                'category' => 'Category',
                'title' => 'Project Title',
            ],
            [
                'image' => asset('themes/wokoya/assets/img/portfolio/4.jpg'),
                'category' => 'Category',
                'title' => 'Project Title',
            ],
            [
                'image' => asset('themes/wokoya/assets/img/portfolio/5.jpg'),
                'category' => 'Category',
                'title' => 'Project Title',
            ],
            [
                'image' => asset('themes/wokoya/assets/img/portfolio/6.jpg'),
                'category' => 'Category',
                'title' => 'Project Title',
            ],

        ];
    }
}
