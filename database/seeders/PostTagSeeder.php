<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all()->pluck('id')->toArray();
        $tag = Tag::all()->pluck('id')->toArray();

        for ($i=0; $i < 20; $i++)
        {
            DB::table('post_tag')->insert([
                'post_id' => $posts[array_rand($posts)],
                'tag_id' => $tag[array_rand($tag)],
            ]);
        }
    }
}
