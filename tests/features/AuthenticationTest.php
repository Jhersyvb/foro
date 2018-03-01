<?php

use App\Token;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    function test_a_user_can_login_with_a_token_url()
    {
        // Having
        $user = $this->defaultUser();

        $token = Token::generateFor($user);

        // When
        $this->visit("login/{$token->token}");

        // Then
        $this->seeIsAuthenticated()
            ->seeIsAuthenticatedAs($user);

        $this->dontSeeInDatabase('tokens', [
            'id' => $token->id
        ]);

        $this->seePageIs('/');
    }
}
