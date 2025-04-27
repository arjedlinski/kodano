<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\ProductCreatedMessage;
use App\Message\SendEmailMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class ProductCreatedMessageHandler
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private LoggerInterface $apiLogger,
    )
    {

    }

    public function __invoke(ProductCreatedMessage $message): void
    {
        $this->apiLogger->info('Product created: ' . $message->getName());
        try {
            $this->messageBus->dispatch(SendEmailMessage::create(
                'x',
                'xx',
                'test',
                'test',
                'sdsdsd'
            ));
        } catch (ExceptionInterface $e) {
            $this->apiLogger->error('Failed to send email' . $e->getMessage());
        }
    }
}