<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\Testing\Fixtures\Requests\Permissions\Authorizations\Remove;

use N1ebieski\KSEFClient\Testing\Fixtures\Requests\AbstractRequestFixture;

final class RemoveRequestFixture extends AbstractRequestFixture
{
    /**
     * @var array<string, mixed>
     */
    public array $data = [
        'permissionId' => '0c9a72e8-f344-457f-9c16-7c640eb60242'
    ];
}
