<?php
declare(strict_types=1);

namespace App\EventSubscriber\Doctrine;

use App\Entity\Product;
use App\Message\ProductCreatedMessage;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Product::class)]
readonly class ProductSubscriber
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {

    }

    /**
     * @throws ExceptionInterface
     */
    public function postPersist(Product $product, PostPersistEventArgs $args): void
    {
        $this->messageBus->dispatch(ProductCreatedMessage::create($product->getId(), $product->getName()));
    }
}