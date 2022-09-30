<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {

            Activity::insert($this->demoActivity($user->getId()));
        }
    }

    public function demoActivity($userId)
    {
        $faker = \Faker\Factory::create();
        $data = [];

        $agent = new Agent(null, (string) $faker->userAgent);

        for ($i=0; $i < 2; $i++) {
            $data[$i] = array(
                'id' => (string)Str::uuid(),
                'description' => $faker->randomElement( array ('Login In','Login Out','Update Profile')),
                'user_id' => $userId,
                'ip_address' => $faker->ipv4,
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'created_at' => $faker->dateTimeBetween("-{$i} day", now()),
            );
        }
        return $data;
    }
}
