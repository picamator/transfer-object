<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum TypeSuffixEnum: string
{
    case TRANSFER = 'Transfer';

    public function getClassName(string $className): string
    {
        return $className . $this->value;
    }
}
