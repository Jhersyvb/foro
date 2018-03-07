<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $post = $this->createPost([
           'title' => 'Como instalar Laravel'
        ]);

        // dd($post->toArray());

        /*$this->seeInDatabase('posts', [
            'slug' => 'como-instalar-laravel'
        ]);

        $this->assertSame('como-instalar-laravel', $post->slug);*/

        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug
        );
    }

    function test_the_url_of_the_post_is_generated()
    {
        $user = $this->defaultUser();

        $post = $this->createPost();

        $this->assertSame(
            $post->url,
            route('posts.show', [$post, $post->slug])
        );
    }
}
