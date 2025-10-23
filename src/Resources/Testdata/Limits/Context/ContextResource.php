<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Resources\Testdata\Limits\Context;

use N1ebieski\KSEFClient\Contracts\HttpClient\HttpClientInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Context\ContextResourceInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Context\Session\SessionResourceInterface;
use N1ebieski\KSEFClient\Resources\AbstractResource;
use N1ebieski\KSEFClient\Resources\Testdata\Limits\Context\Session\SessionResource;

final class ContextResource extends AbstractResource implements ContextResourceInterface
{
    public function __construct(
        private readonly HttpClientInterface $client
    ) {
    }

    public function session(): SessionResourceInterface
    {
        return new SessionResource($this->client);
    }
}
