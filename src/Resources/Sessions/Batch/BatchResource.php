<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Resources\Sessions\Batch;

use N1ebieski\KSEFClient\Actions\EncryptDocument\EncryptDocumentHandler;
use N1ebieski\KSEFClient\Actions\SplitDocumentIntoParts\SplitDocumentIntoPartsHandler;
use N1ebieski\KSEFClient\Actions\ZipDocuments\ZipDocumentsHandler;
use N1ebieski\KSEFClient\Contracts\HttpClient\HttpClientInterface;
use N1ebieski\KSEFClient\Contracts\HttpClient\ResponseInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Sessions\Batch\BatchResourceInterface;
use N1ebieski\KSEFClient\DTOs\Config;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Close\CloseHandler;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Close\CloseRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenHandler;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenXmlRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\OpenZipRequest;
use N1ebieski\KSEFClient\Resources\AbstractResource;
use Psr\Log\LoggerInterface;

final class BatchResource extends AbstractResource implements BatchResourceInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly Config $config,
        private readonly ?LoggerInterface $logger = null
    ) {
    }

    public function open(OpenRequest | OpenXmlRequest | OpenZipRequest | array $request): ResponseInterface
    {
        if (is_array($request)) {
            $request = OpenRequest::from($request);
        }

        return (new OpenHandler(
            client: $this->client,
            config: $this->config,
            encryptDocumentHandler: new EncryptDocumentHandler($this->logger),
            zipDocumentsHandler: new ZipDocumentsHandler(),
            splitDocumentIntoPartsHandler: new SplitDocumentIntoPartsHandler()
        ))->handle($request);
    }

    public function close(CloseRequest | array $request): ResponseInterface
    {
        if ($request instanceof CloseRequest === false) {
            $request = CloseRequest::from($request);
        }

        return (new CloseHandler($this->client))->handle($request);
    }
}
