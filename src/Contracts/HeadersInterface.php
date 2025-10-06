<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Contracts;

interface HeadersInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toHeaders(): array;
}
