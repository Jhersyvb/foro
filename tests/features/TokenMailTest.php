<?php

use App\{User, Token};
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Mail\Mailable;

class TokenMailTest extends FeatureTestCase
{
    /**
     * @test
     */
    function it_sends_a_link_with_the_token()
    {
        $user = new User([
            'first_name' => 'Jhersy',
            'last_name' => 'Valer Bejarano',
            'email' => 'hola@jhersy.com'
        ]);

        $token = new Token([
            'token' => 'this-is-a-token',
            'user' => $user
        ]);

        // SMTP -> Mailtrap
        // API Mailtrap -> data

        $this->open(new TokenMail($token))
            ->seeLink($token->url, $token->url);
    }

    // InteractsWithMailable
    protected function open(Mailable $mailable)
    {
        $transport = Mail::getSwiftMailer()->getTransport();

        $transport->flush();

        Mail::send($mailable);

        $message = $transport->messages()->first();

        $this->crawler = new Crawler($message->getBody());

        return $this;
    }
}
