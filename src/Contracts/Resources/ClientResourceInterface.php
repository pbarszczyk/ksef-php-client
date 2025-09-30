<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Contracts\Resources;

use N1ebieski\KSEFClient\Contracts\Resources\Common\CommonResourceInterface;
use N1ebieski\KSEFClient\Contracts\Resources\Online\OnlineResourceInterface;
use N1ebieski\KSEFClient\HttpClient\ValueObjects\AccessToken;

interface ClientResourceInterface
{
    public function getSessionToken(): ?AccessToken;

    public function withSessionToken(AccessToken | string $sessionToken): self;

    public function online(): OnlineResourceInterface;

    public function common(): CommonResourceInterface;
}
