<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Resources\Testdata\Limits;

use N1ebieski\KSEFClient\Contracts\HttpClient\HttpClientInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Context\ContextResourceInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\LimitsResourceInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Subject\SubjectResourceInterface;
use N1ebieski\KSEFClient\Resources\AbstractResource;
use N1ebieski\KSEFClient\Resources\Testdata\Limits\Context\ContextResource;
use N1ebieski\KSEFClient\Resources\Testdata\Limits\Subject\SubjectResource;

final class LimitsResource extends AbstractResource implements LimitsResourceInterface
{
    public function __construct(
        private readonly HttpClientInterface $client
    ) {
    }

    public function context(): ContextResourceInterface
    {
        return new ContextResource($this->client);
    }

    public function subject(): SubjectResourceInterface
    {
        return new SubjectResource($this->client);
    }
}
