<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posts = Post::all()->pluck('id')->toArray();
        return [
            'body' => $this->faker->sentence(5),
            'post_id' => $posts[ array_rand( $posts )],

        ];
    }
}
