<?php

namespace Plugins\Contact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Plugins\Contact\Models\Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'subject' => $this->faker->sentence,
            'message' => implode(PHP_EOL, $this->faker->paragraphs),
            'is_read' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween("-300 day", now()),
        ];
    }



}
