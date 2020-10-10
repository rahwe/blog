<?php

use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /**
         * create post by asigning user_id to each post.
         * because post need any user to create post.
         * 
         *  */ 
        // creat 50 posts and each post asigned random user_id 
        $blogpostCount = (int)$this->command->ask('How many post do you want to create?', 50);
        $all_users = App\User::all();
        factory(App\BlogPost::class, $blogpostCount)->make()->each(function($post) use($all_users){
            $post->user_id = $all_users->random()->id;
            $post->save();
         });
    }
}
