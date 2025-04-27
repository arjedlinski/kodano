<?php

declare(strict_types=1);

namespace App\Message;

readonly class SendEmailMessage
{
    public static function create(string $from, string $to, string $subject, string $text, string $html,): self
    {
        return new self($from, $to, $subject, $text, $html);
    }

    private function __construct(
        private string $from,
        private string $to,
        private string $subject,
        private string $text,
        private string $html,
    ) {
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getHtml(): string
    {
        return $this->html;
    }
}
