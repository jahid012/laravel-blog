<?php

namespace Wokoya\Support\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // create users
        \App\Models\User::factory(100)->create();
        // //create demo admin
        $this->createUser();
        // // //create activitys
        $this->call(\Database\Seeders\ActivityTableSeeder::class);

        //plugins seeders
        $this->call(\Plugins\Blog\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Contact\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Faq\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Portfolio\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Price\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Qualification\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Service\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Skill\Database\Seeders\DatabaseSeeder::class);
        $this->call(\Plugins\Testimonial\Database\Seeders\DatabaseSeeder::class);

    }

    /**
     * Create Demo user
     *
     * username: admin
     * email: admin@admin.com
     * password: password
     */
    public function createUser()
    {
        $role = Role::where('name', 'admin')->first();

        return User::firstOrCreate(
            array(
                "username" => "admin",
                "email" => "admin@admin.com",
            ),
            array(
                'id' => Str::uuid(),
                "username" => "admin",
                "email" => "admin@admin.com",
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                "email_verified_at" => now(),
                'role_id' => $role->id,
                'avatar' => asset('uploads/2021/11/avatar.png')
            )
        );
    }
}
