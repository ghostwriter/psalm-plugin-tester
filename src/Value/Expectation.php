<?php

declare(strict_types=1);

namespace Ghostwriter\PsalmPluginTester\Value;

use Stringable;

final class Expectation implements Stringable
{
    public function __construct(
        private readonly string $file,
        private readonly string $type,
        private readonly string $message,
    ) {
    }

    public function __toString(): string
    {
        return sprintf(
            '%s: %s | %s',
            $this->file,
            $this->type,
            $this->message,
        );
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getType(): string
    {
        return $this->type;
    }
}