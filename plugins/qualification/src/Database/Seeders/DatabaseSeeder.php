<?php

namespace Plugins\Qualification\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Qualification\Models\Qualification;

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
            Qualification::updateOrCreate([
                'type'          => $price['type'],
                'icon'          => $price['icon'],
                'name'          => $price['name'],
                'institute'     => $price['institute'],
                'description'   => $price['description'],
                'start_at'      => $price['start_at'],
                'end_at'        => $price['end_at'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'type' => 'experience',
                'icon' => 'icofont-designfloat',
                'name' => 'UX / UI Designer',
                'institute' => 'Apple Inc ',
                'description' => 'Contrary the on way yollis pellentesque pellentesque feugiat risus met.',
                'start_at' => '2017',
                'end_at' => '2020'
            ],
            [
                'type' => 'experience',
                'icon' => 'icofont-file-python',
                'name' => 'Web Developer',
                'institute' => 'Ducor Ptv Ltd',
                'description' => 'Contrary the on way yollis pellentesque pellentesque feugiat risus nunc.',
                'start_at' => '2008',
                'end_at' => '2014'
            ],
            [
                'type' => 'experience',
                'icon' => 'icofont-file-python',
                'name' => 'python Developer',
                'institute' => 'Google Inc ',
                'description' => 'Contrary the on way yollis pellentesque pellentesque feugiat risus nunc.',
                'start_at' => '2015',
                'end_at' => '2016'
            ],

            //Experience
            [
                'type' => 'education',
                'icon' => 'icofont-graduate',
                'name' => 'MSc in CSE ',
                'institute' => 'University of Enkha',
                'description' => 'Contrary the on way yollis pellentesque pellentesque feugiat risus nunc.',
                'start_at' => '2007',
                'end_at' => '2008'
            ],
            [
                'type' => 'education',
                'icon' => 'icofont-graduate',
                'name' => 'BSc in CSE ',
                'institute' => 'University of Enkha',
                'description' => 'Contrary the on way yollis pellentesque pellentesque feugiat risus nunc.',
                'start_at' => '2003',
                'end_at' => '2006'
            ],
            [
                'type' => 'education',
                'icon' => 'icofont-ui-copy',
                'name' => 'Enkha College ',
                'institute' => 'High School Diploma',
                'description' => 'Contrary the on way yollis pellentesque pellentesque feugiat risus nunc.',
                'start_at' => '2001',
                'end_at' => '2003'
            ],

        ];
    }
}
