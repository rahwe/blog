<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\BlogPost;
use App\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    

    public function testNoBlogPostYet()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('No blog post yet');
    }

    public function test1BlogpostWhenThereIs1WithNoComment()
    {
        // arrage part
        $post = $this->createDummyPost();

        // actinon part

        $response = $this->get('/posts');

        // assertion part
        $response->assertSeeText('New title');
        $this->assertDatabaseHas('blog_posts', [
            'title'=> 'New title'
        ]);


    }
    public function test1BlogpostWithComment()
    {
        // arrage part
        $post = $this->createDummyPost();
        // 4 fak comment create for $post->id
        factory(Comment::class, 4)->create([
            'blog_post_id'=> $post->id
        ]);

        $response = $this->get('/posts');
        $response->assertSeeText('4 comments');
    }

    public function testIsStoreValid()
    {
        //arrang
        $param = [
            'title' => 'Valid title',
            'content' => 'Valid Content'
        ];
        // Because we use middleware to protect 
        // store data in PostController 
        // So we make sure user is Authenticated first.
        // So we use actingAs($this->user())
        $this->actingAs($this->user())
            ->post('/posts', $param)
            // 302 redirect page
            ->assertStatus(302)
            ->assertSessionHas('alert');

        $this->assertEquals(session('alert'), 'Post is created succesfully.');
            
    }

    public function testIsStoreUnvalid()
    {
        //arrang
        $param = [
            'title' => 'x',
            'content' => 'x'
        ];

        //action part
        $this->actingAs($this->user())
            ->post('/posts', $param)
            // 302 redirect page
            ->assertStatus(302)
            ->assertSessionHas('errors');

            $messages = session('errors')->getMessages();
            $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
            $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');


    }

    public function testPostUpdate()
    {
        // arrage part
        $post = $this->createDummyPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $param = [
            'title' => 'New update title',
            'content' => 'New update content'
        ];


        // action part
        $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $param)
            // 302 redirect page
            ->assertStatus(302)
            ->assertSessionHas('alert');

        $this->assertEquals(session('alert'), 'Post is updated succesfully.');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New update title',
            'content' => 'New update content'
        ]);
        
    }

    public function testDeletePost()
    {
        // Arrang Part
        $post = $this->createDummyPost();

        // action part
        $this->actingAs($this->user())
            ->delete("/posts/{$post->id}")
            // 302 redirect page
            ->assertStatus(302)
            ->assertSessionHas('alert');
        $this->assertEquals(session('alert'), 'Post is deleted successully.');
        //$this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertSoftDeleted('blog_posts', $post->toArray());
    }

    private function createDummyPost(): BlogPost
    {
        // $post = new BlogPost();
        // $post->title = 'New title';
        // $post->content = 'New Content';
        // $post->save();
        // return $post;
        return factory(BlogPost::class)->states('new-title')->create();
    }

  
}
