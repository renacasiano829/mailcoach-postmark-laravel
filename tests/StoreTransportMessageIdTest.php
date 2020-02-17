<?php

namespace Spatie\MailcoachPostmarkFeedback\Tests;

use Illuminate\Mail\Events\MessageSent;
use Spatie\Mailcoach\Models\Send;
use Swift_Message;

class StoreTransportMessageIdTest extends TestCase
{
    /** @test * */
    public function it_stores_the_message_id_from_the_transport()
    {
        $pendingSend = factory(Send::class)->create();
        $message = new Swift_Message('Test', 'body');
        $message->getHeaders()->addTextHeader('X-Postmark-Message-ID', '1234');

        event(new MessageSent($message, [
            'send' => $pendingSend,
        ]));

        tap($pendingSend->fresh(), function (Send $send) {
            $this->assertEquals('1234', $send->transport_message_id);
        });
    }
}
