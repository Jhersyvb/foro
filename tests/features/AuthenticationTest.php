<?php

use App\Token;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class AuthenticationTest extends FeatureTestCase
{
    function test_a_guest_user_can_request_a_token()
    {
        // Having
        Mail::fake();

        $user = $this->defaultUser(['email' => 'hola@jhersy.com']);

        // When
        $this->visitRoute('login')
            ->type('hola@jhersy.com', 'email')
            ->press('Solicitar token');

        // Then: a new token is created in the database
        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token, 'A token was not created');

        // And sent to the user
        Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id === $token->id;
        });

        $this->dontSeeIsAuthenticated();

        $this->seeRouteIs('login_confirmation')
            ->see('Enviamos a tu email un enlace para que inicies sesion');
    }
}
