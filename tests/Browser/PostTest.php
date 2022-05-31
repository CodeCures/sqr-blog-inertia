<?php

namespace Tests\Browser;

use App\Enums\UserRole;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_view_index_of_posts()
    {

        $posts = Post::factory(20)->create([
            'user_id' => User::factory()->create()->id
        ]);
        
        $this->browse(function (Browser $browser) use($posts){
            $browser->visit('/')
                    ->assertSee('Blog')
                    ->assertSee($posts->first()->title);

            if ($browser->seeLink('Next')) {
                $browser->clickLink('Next')
                        ->assertSeeLink('Previous')
                        ->clickLink('Previous')
                        ->assertDontSeeLink('Previous')
                        ->assertSeeLink('Next');
            }
        });
    }

    /** @test */
    public function can_search_posts()
    {
    
        $post = Post::factory([
            'user_id' => User::factory()->create()->id
        ])->create();
        
        $this->browse(function (Browser $browser) use ($post) {
            $browser->visit('/')
                    ->assertSee('Blog')
                    ->type('search', $post->first()->title)
                    ->press('Search')
                    ->assertSee($post->first()->title);
        });
    }

    /** @test */
    public function can_view_post()
    {
    
        $post = Post::factory([
            'user_id' => User::factory()->create()->id
        ])->create();
        
        $this->browse(function (Browser $browser) use ($post) {
            $browser->visit('/')
                    ->assertSee('Blog')
                    ->assertSee($post->title)
                    ->clickLink($post->title)
                    ->assertRouteIs('posts.show', $post)
                    ->assertSee($post->description);
        });
    }

    /** @test */
    public function can_creat_post()
    {
    
        $post = Post::factory([
            'user_id' => User::factory()->create()->id
        ])->create();
        
        $this->browse(function (Browser $browser) use ($post) {
            $browser->loginAs($post->user)
                    ->visit('/dashboard')
                    ->assertRouteIs('dashboard')
                    ->assertSee("Create Post")
                    ->clickLink("Create Post")
                    ->assertRouteIs('post.create')
                    ->type('title', 'this is the best title ever')
                    ->type('description', 'this is so satisfying')
                    ->press('Create Now')
                    ->assertRouteIs('dashboard')
                    ->assertSee('post created successfully!')
                    ->assertSee('this is the');
        });
    }

    /** @test */
    public function can_edit_post()
    {
    
        $post = Post::factory([
            'user_id' => User::factory()->create()->id,
        ])->create();
        
        $this->browse(function (Browser $browser) use ($post) {
            $browser->loginAs($post->user)
                    ->visit('/dashboard?order=ASC')
                    ->assertSeeLink('edit')
                    ->clickLink('edit')
                    ->type('title', $post->title.' is yet to come')
                    ->type('description', $post->title)
                    ->press('Update Now')
                    ->assertRouteIs('dashboard')
                    ->assertSee('post updated successfully!');
        });
    }

     /** @test */
     public function cannot_edit_post()
     {
     
         $post = Post::factory([
             'user_id' => User::factory([
                'role' => UserRole::User
             ])->create()->id,
         ])->create();
         
         $this->browse(function (Browser $browser) use ($post) {
             $browser->loginAs($post->user)
                     ->visit('/dashboard?order=ASC')
                     ->assertDontSeeLink('edit');
                    //  ->visitRoute('post.edit', $post) // this will break the loop and return 403 error
                    //  ->assertDontSee('Update Now');
         });
     }

    /** @test */
    public function can_delete_post()
    {
    
        $post = Post::factory([
            'user_id' => User::factory()->create()->id,
        ])->create();
        
        $this->browse(function (Browser $browser) use ($post) {
            $browser->loginAs($post->user)
                    ->visit('/dashboard?order=ASC')
                    ->assertSeeLink('delete')
                    ->clickLink('delete')
                    ->assertRouteIs('dashboard')
                    ->assertSee('post deleted successfully!');
        });
    }

    /** @test */
    public function cannot_delete_post()
    {
    
        $post = Post::factory([
            'user_id' => User::factory([
                'role' => UserRole::User
            ])->create()->id,
        ])->create();
        
        $this->browse(function (Browser $browser) use ($post) {
            $browser->loginAs($post->user)
                    ->visit('/dashboard?order=ASC')
                    ->assertDontSee('delete');
        });
    }
    
}
