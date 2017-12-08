<?php

class ShowPostTest extends TestCase
{
    public function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'name' => 'Jhersy Valer Bejarano'
        ]);

        $post = factory(\App\Post::class)->make([
            'title'   => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post.'
        ]);

        $user->posts()->save($post);

        $this->visit($post->url) // posts/1990
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see($user->name);
    }

    /*function test_post_url_with_wrong_slugs_still_work()
    {
        // Having
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([
            'title' => 'Old title'
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        // $this->visit($url)
        //     ->assertResponseOk()
        //     ->see('New title');

        $this->get($url)
            ->assertResponseStatus(404);
    }*/

    function test_old_urls_are_redirected()
    {
        // Having
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([
            'title' => 'Old title'
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
