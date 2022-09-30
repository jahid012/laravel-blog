<?php

namespace Plugins\Blog\Database\Factories;

use App\Facades\Seo;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Plugins\Blog\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Plugins\Blog\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $category = Category::first();
        $user = User::first();

        $seo_id = (string)Str::uuid();
        $seo = Seo::create([
            'id' => $seo_id,
        ]);

        $title = $this->faker->sentence;
        $array = [1, 2, 3];

        return [
            'category_id' => $category->id,
            'seo_id' => $seo_id,
            'user_id' => $user->getId(),
            'title' => $title,
            'slug' => Str::slug($title),
            'summary' => $this->faker->paragraph,
            'content' => implode(PHP_EOL, $this->faker->paragraphs),
            'featured_image' => asset('themes/wokoya/assets/img/blog/'.Arr::random($array).'.png'),
            'tags' => '',
        ];
    }



}


