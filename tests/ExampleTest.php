<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        /* $user = factory(App\User::class)->create();

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see($user->name); */

        $user = factory(App\User::class)->create([
            'name' => 'Jhersy Valer Bejarano',
            'email' => 'admin@jhersy.com'
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('Jhersy')
            ->see('admin@jhersy.com');
    }
}
