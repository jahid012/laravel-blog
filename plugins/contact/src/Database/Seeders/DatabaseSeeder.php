<?php

namespace Plugins\Contact\Database\Seeders;

use Illuminate\Database\Seeder;
use Plugins\Contact\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Contact::factory(100)->create();
    }
}
