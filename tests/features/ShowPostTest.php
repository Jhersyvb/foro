<?php

class ShowPostTest extends FeatureTestCase
{
    public function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'name' => 'Jhersy Valer Bejarano'
        ]);

        $post = $this->createPost([
            'title'   => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post.',
            'user_id' => $user->id
        ]);

        // dd(\App\User::all()->toArray(), $post->user_id);

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
        $post = $this->createPost([
            'title' => 'Old title'
        ]);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
