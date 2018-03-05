<?php

use App\{User, Token};
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends FeatureTestCase
{
    function test_a_user_can_create_an_account()
    {
        Mail::fake();

        $this->visitRoute('register')
            ->type('hola@jhersy.com', 'email')
            ->type('Jhersyvb', 'username')
            ->type('Jhersy', 'first_name')
            ->type('Valer Bejarano', 'last_name')
            ->press('Regístrate');

        $this->seeInDatabase('users', [
            'email' => 'hola@jhersy.com',
            'username' => 'Jhersyvb',
            'first_name' => 'Jhersy',
            'last_name' => 'Valer Bejarano'
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens', [
            'user_id' => $user->id
        ]);

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);

        Mail::assertSent(TokenMail::class, function ($mail) use ($token, $user) {
            return $mail->hasTo($user) && $mail->token->id == $token->id;
        });

        // todo: finish this feature
        return;

        $this->seeRouteIs('register_confirmation')
            ->see('Gracias por registrarte')
            ->see('Enviamos a tu email un enlace para que inicies sesion');
    }
}
