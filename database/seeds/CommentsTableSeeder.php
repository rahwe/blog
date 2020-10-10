<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_posts = App\BlogPost::all();
        if($all_posts->count() === 0){
            $this->command->info('There no post so no comment.');
            return;
        }
        $commentCount = (int)$this->command->ask('How many comments do you want to create?', 150);
        // create 150 comment and asigned post id to every comment
        
        factory(App\Comment::class, $commentCount)->make()->each(function($comment) use($all_posts){
           $comment->blog_post_id = $all_posts->random()->id;
           $comment->save();
        });
    }
}
