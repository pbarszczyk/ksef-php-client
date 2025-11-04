<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Resources\Permissions\Common;

use N1ebieski\KSEFClient\Contracts\Exception\ExceptionHandlerInterface;
use N1ebieski\KSEFClient\Contracts\HttpClient\HttpClientInterface;
use N1ebieski\KSEFClient\Contracts\HttpClient\ResponseInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Permissions\Common\CommonResourceInterface;
use N1ebieski\KSEFClient\Requests\Permissions\Common\Remove\RemoveHandler;
use N1ebieski\KSEFClient\Requests\Permissions\Common\Remove\RemoveRequest;
use N1ebieski\KSEFClient\Resources\AbstractResource;
use Throwable;

final class CommonResource extends AbstractResource implements CommonResourceInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly ExceptionHandlerInterface $exceptionHandler
    ) {
    }

    public function remove(RemoveRequest | array $request): ResponseInterface
    {
        try {
            if ($request instanceof RemoveRequest === false) {
                $request = RemoveRequest::from($request);
            }

            return (new RemoveHandler($this->client))->handle($request);
        } catch (Throwable $throwable) {
            throw $this->exceptionHandler->handle($throwable);
        }
    }
}
