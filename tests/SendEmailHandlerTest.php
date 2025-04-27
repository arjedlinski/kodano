<?php
declare(strict_types=1);

use App\Message\SendEmailMessage;
use App\MessageHandler\SendEmailMessageHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendEmailHandlerTest extends TestCase
{
    public function testHandlerSendsEmail()
    {
        $mailer = $this->createMock(MailerInterface::class);

        $mailer->expects($this->once())
            ->method('send')
            ->with($this->callback(function (Email $email) {
                return
                    $email->getTo()[0]->getAddress() === 'test@test.com' &&
                    $email->getSubject() === '' &&
                    $email->getFrom()[0]->getAddress() === 'test@test.pl';
            }));

        $handler = new SendEmailMessageHandler($mailer);

        $message = SendEmailMessage::create('test@test.pl', 'test@test.com', '', '', '');

        $handler($message);
    }
}