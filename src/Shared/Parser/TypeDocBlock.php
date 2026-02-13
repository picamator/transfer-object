<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Parser;

readonly class TypeDocBlock
{
    public function __construct(
        public string $type,
        public ?string $docBlock = null,
    ) {
    }
}
