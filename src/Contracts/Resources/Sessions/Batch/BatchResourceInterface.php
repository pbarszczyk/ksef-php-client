<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Contracts\Resources\Sessions\Batch;

use N1ebieski\KSEFClient\Contracts\HttpClient\ResponseInterface;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Close\CloseRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenXmlRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenZipRequest;

interface BatchResourceInterface
{
    /**
     * @param OpenRequest|OpenXmlRequest|OpenZipRequest|array<string, mixed> $request
     */
    public function open(OpenRequest | OpenXmlRequest | OpenZipRequest | array $request): ResponseInterface;

    /**
     * @param CloseRequest|array<string, mixed> $request
     */
    public function close(CloseRequest | array $request): ResponseInterface;
}
