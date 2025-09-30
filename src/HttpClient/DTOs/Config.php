<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\HttpClient\DTOs;

use N1ebieski\KSEFClient\HttpClient\ValueObjects\BaseUri;
use N1ebieski\KSEFClient\HttpClient\ValueObjects\AccessToken;
use N1ebieski\KSEFClient\Support\AbstractDTO;
use SensitiveParameter;

final readonly class Config extends AbstractDTO
{
    public function __construct(
        public BaseUri $baseUri,
        #[SensitiveParameter]
        public ?AccessToken $sessionToken = null
    ) {
    }

    public function withSessionToken(AccessToken $sessionToken): self
    {
        return new self($this->baseUri, $sessionToken);
    }
}
