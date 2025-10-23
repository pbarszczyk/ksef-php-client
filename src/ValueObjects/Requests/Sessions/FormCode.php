<?php

declare(strict_types=1);

namespace N1ebieski\KSEFClient\ValueObjects\Requests\Sessions;

use N1ebieski\KSEFClient\Contracts\EnumInterface;

enum FormCode: string implements EnumInterface
{
    case Fa2 = 'FA (2)';

    case Fa3 = 'FA (3)';

    case Pef3 = 'PEF (3)';

    case KorPef3 = 'KOR_PEF (3)';

    public function getSchemaVersion(): string
    {
        return match ($this) {
            self::Fa2, self::Fa3 => '1-0E',
            self::Pef3, self::KorPef3 => '2-1',
        };
    }

    public function getValue(): string
    {
        return match ($this) {
            self::Fa2, self::Fa3 => 'FA',
            self::Pef3, self::KorPef3 => 'PEF',
        };
    }

    public function getTargetNamespace(): string
    {
        return match ($this) {
            self::Fa2 => 'http://crd.gov.pl/wzor/2023/06/29/12648/',
            self::Fa3, self::Pef3, self::KorPef3 => 'http://crd.gov.pl/wzor/2025/06/25/13775/'
        };
    }

    public function getWariantFormularza(): string
    {
        return match ($this) {
            self::Fa2 => '2',
            self::Fa3, self::Pef3, self::KorPef3 => '3',
        };
    }
}
