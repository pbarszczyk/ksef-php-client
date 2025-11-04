<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Contracts\Resources\Permissions\Common;

use N1ebieski\KSEFClient\Contracts\HttpClient\ResponseInterface;
use N1ebieski\KSEFClient\Requests\Permissions\Common\Remove\RemoveRequest;

interface CommonResourceInterface
{
    /**
     * @param RemoveRequest|array<string, mixed> $request
     */
    public function remove(RemoveRequest | array $request): ResponseInterface;
}
