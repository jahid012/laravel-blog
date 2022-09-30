<?php

namespace Plugins\Testimonial\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Testimonial\Models\Testimonial;

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
            Testimonial::updateOrCreate([
                'quote'          => $price['quote'],
                'author_name'    => $price['author_name'],
                'author_image'   => $price['author_image'],
                'author_intro'   => $price['author_intro'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/1.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/2.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/3.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/1.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/2.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/3.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
            [
                'quote'         => 'Printing and typesetting industry Lorem Ipsum has the industry\'s standard dummy text ever the since the 1500s when an unknown took.',
                'author_name'   => 'Devid Nikolas',
                'author_image'  => asset('themes/wokoya/assets/img/client/1.jpg'),
                'author_intro'  => 'Chairman, Square Inc',
            ],
        ];
    }
}
