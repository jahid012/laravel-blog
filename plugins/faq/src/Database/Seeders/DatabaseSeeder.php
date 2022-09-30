<?php

namespace Plugins\Faq\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Faq\Models\Faq;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data() as $faq) {
            Faq::create([
                'ask'       => $faq['ask'],
                'answer'    => $faq['answer'],
            ]);
        }
    }

    public function data()
    {
        return [
            [
                'ask' => 'What services do I offer ?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusitempor is exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
            ],
            [
                'ask' => 'How will I complete your project?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusitempor is exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
            ],
            [
                'ask' => 'How will you pay me?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusitempor is exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
            ],
            [
                'ask' => 'Why will you hire for your proejdct?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusitempor is exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
            ],
            [
                'ask' => 'How will you get final project?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusitempor is exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
            ],
            [
                'ask' => 'What is the process & my time zone?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusitempor is exercitation ullamco laboris.Lorem ipsum dolor sit amet, consectetur adipisicing elit. '
            ],
        ];
    }
}
