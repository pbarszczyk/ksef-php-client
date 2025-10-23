<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Resources\Testdata\Limits\Subject;

use N1ebieski\KSEFClient\Contracts\HttpClient\HttpClientInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Subject\Certificate\CertificateResourceInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Subject\SubjectResourceInterface;
use N1ebieski\KSEFClient\Resources\AbstractResource;
use N1ebieski\KSEFClient\Resources\Testdata\Limits\Subject\Certificate\CertificateResource;

final class SubjectResource extends AbstractResource implements SubjectResourceInterface
{
    public function __construct(
        private readonly HttpClientInterface $client
    ) {
    }

    public function certificate(): CertificateResourceInterface
    {
        return new CertificateResource($this->client);
    }
}
