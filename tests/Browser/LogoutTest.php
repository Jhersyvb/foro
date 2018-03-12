<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends DuskTestCase
{
    Use DatabaseMigrations;

    function test_a_user_can_logout()
    {
        $user = $this->defaultUser([
            'first_name' => 'Jhersy',
            'last_name' => 'Valer Bejarano',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/')
                ->clickLink('Jhersy Valer Bejarano')
                ->clickLink('Cerrar sesión')
                ->assertGuest();
        });
    }
}
