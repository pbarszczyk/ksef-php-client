<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Resources\Testdata\Limits\Subject\Certificate;

use N1ebieski\KSEFClient\Contracts\HttpClient\HttpClientInterface;
use N1ebieski\KSEFClient\Contracts\HttpClient\ResponseInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Testdata\Limits\Subject\Certificate\CertificateResourceInterface;
use N1ebieski\KSEFClient\Requests\Testdata\Limits\Subject\Certificate\Limits\LimitsHandler;
use N1ebieski\KSEFClient\Requests\Testdata\Limits\Subject\Certificate\Limits\LimitsRequest;
use N1ebieski\KSEFClient\Requests\Testdata\Limits\Subject\Certificate\Reset\ResetHandler;
use N1ebieski\KSEFClient\Resources\AbstractResource;

final class CertificateResource extends AbstractResource implements CertificateResourceInterface
{
    public function __construct(
        private readonly HttpClientInterface $client
    ) {
    }

    public function limits(LimitsRequest | array $request): ResponseInterface
    {
        if ($request instanceof LimitsRequest === false) {
            $request = LimitsRequest::from($request);
        }

        return (new LimitsHandler($this->client))->handle($request);
    }

    public function reset(): ResponseInterface
    {
        return (new ResetHandler($this->client))->handle();
    }
}
