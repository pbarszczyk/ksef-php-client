<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Contracts;

/**
 * @property-read object|array<string, mixed>|null $context
 */
interface ContextInterface
{
    /**
     * @return object|array<string, mixed>|null
     */
    public function getContext(): object|array|null;
}
