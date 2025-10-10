<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Requests\Sessions\Batch\Open;

use N1ebieski\KSEFClient\Contracts\BodyInterface;
use N1ebieski\KSEFClient\Requests\AbstractRequest;
use N1ebieski\KSEFClient\Requests\Sessions\Batch\Open\Concerns\HasToBody;
use N1ebieski\KSEFClient\Support\Optional;
use N1ebieski\KSEFClient\ValueObjects\Requests\Sessions\FormCode;

final class OpenZipRequest extends AbstractRequest implements BodyInterface
{
    use HasToBody;

    /**
     * @param string $faktury
     * @return void
     */
    public function __construct(
        public readonly FormCode $formCode,
        public readonly string $faktury,
        public readonly Optional | bool $offlineMode = new Optional(),
    ) {
    }
}
