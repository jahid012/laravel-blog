<?php

namespace Plugins\Skill\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Skill\Models\Skill;

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
            Skill::updateOrCreate([
                'type'          => $price['type'],
                'name'          => $price['name'],
                'percentage'    => $price['percentage'],
            ]);
        }
    }

    public function data()
    {
        return [
            //professional
            [
                'type'          => 'professional',
                'name'          => 'Wordpress Ninja ',
                'percentage'    => 85,
            ],
            [
                'type'          => 'professional',
                'name'          => 'UX/UI Design ',
                'percentage'    => 95,
            ],
            [
                'type'          => 'professional',
                'name'          => 'Python Development ',
                'percentage'    => 75,
            ],
            // language
            [
                'type'          => 'language',
                'name'          => 'English',
                'percentage'    => 85,
            ],
            [
                'type'          => 'language',
                'name'          => 'French',
                'percentage'    => 95,
            ],
            [
                'type'          => 'language',
                'name'          => 'Arabic',
                'percentage'    => 75,
            ],

        ];
    }
}
