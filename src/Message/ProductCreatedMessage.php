<?php
declare(strict_types=1);

namespace App\Message;

final readonly class ProductCreatedMessage
{
    public static function create(int $id, string $name): self
    {
        return new self($id, $name);
    }

    private function __construct(
        private int $id,
        private string $name
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
