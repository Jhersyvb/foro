<?php

class ExampleTest extends FeatureTestCase
{
    function test_basic_example()
    {
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
