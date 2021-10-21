<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        
        Comment::factory(150)->make()->each(function ($comment) use($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
