<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlockPostsWhenNothingInDatabase()
    {
        //act
        $response = $this->get('/posts');
        //assert
        $response->assertSeeText('No posts found!');
    }

    public function testSee1BlogPostWhenThereIs1WithNoComment()
    {
        //arrange
        $post = $this->createDummyBlogPost();

        //act
        $response = $this->get('/posts');

        //assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        $post = $this->createDummyBlogPost();

        //factory
        Comment::factory(4)->create([
            'blog_post_id' => $post->id
        ]);

        $response= $this->get('/posts');

        $response->assertSeeText('4 comments');
    }

    public function testStoreValid()
    {
        // create auteh
        $this->actingAs($this->user());

        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ]; 

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'),'The blog post was created!');
    }

    public function testStoreInvalidParameter()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        // create auteh
        $this->actingAs($this->user());

        $this->post('/posts',$params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0],'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0],'The content must be at least 10 characters.');
        
    }

    public function testUpdateValid()
    {
        $user = $this->user();
        //arrange
        $post = $this->createDummyBlogPost($user->id);

        // $this->assertDatabaseHas('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post'
        ]);

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];

        // create auteh
        $this->actingAs($user);

        $this->put("/posts/{$post->id}",$params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'),'Blog post was updated!');
    
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post'
        ]);

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ]);
    }

    public function testDelete()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post'
        ]);

        // create auteh
        $this->actingAs($user);
        
        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'),'Blog post was deleted!');
        
        // $this->assertDatabaseMissing('blog_posts', [
        //     'title' => 'New title',
        //     'content' => 'Content of the blog post'
        // ]);
        $this->assertSoftDeleted('blog_posts', [
            'title' => 'New title',
            'content' => 'Content of the blog post'
        ]);
    }

    private function createDummyBlogPost($userId = null): BlogPost
    {
        // $post = new BlogPost();
        // $post->title = 'New title';
        // $post->content = 'Content of the blog post';
        // $post->save();
        // return $post; 
             
        return BlogPost::factory()->newTitle()->create(
            [
                'user_id' => $userId ?? $this->user()->id,
            ]
        );

    }
}
