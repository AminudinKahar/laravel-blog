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

        if ($posts->count() === 0) {
            $this->command->info('There are no blog posts, so no comments will be added');
            return;
        }
      
        $commentsCount = (int)$this->command->ask('How many comments would you like?',150);

        Comment::factory($commentsCount)->make()->each(function ($comment) use($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
