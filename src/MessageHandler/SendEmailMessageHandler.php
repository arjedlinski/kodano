<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
readonly class SendEmailMessageHandler
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(SendEmailMessage $message): void
    {
        $email = (new Email())
            ->from($message->getFrom())
            ->to($message->getTo())
            ->subject($message->getSubject())
            ->text($message->getText())
            ->html($message->getHtml());
        $this->mailer->send($email);
    }
}
