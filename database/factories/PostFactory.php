<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
   /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $category = Category::all()->pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence(1),
            'body' => $this->faker->sentence(10),
            'image' => 'public/theme/images/name.jpg',
            'user_id' => $users[array_rand($users)],
            'category_id' => $category[array_rand($category)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
