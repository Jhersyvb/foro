<?php

use App\{Post, User};

class UserModelTest extends TestCase
{
    function test_user_owner_of_model_owns_the_model()
    {
        $author = new User();
        $author->id = 1;

        $post = new Post();
        $post->user_id = $author->id;

        $this->assertTrue($author->owns($post));
    }

    function test_user_non_owner_of_model_does_not_own_the_model()
    {
        $author = new User();
        $author->id = 1;

        $user = new User();
        $user->id = 2;

        $post = new Post();
        $post->user_id = $user->id;

        $this->assertFalse($author->owns($post));
    }
}
