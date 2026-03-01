<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Filter;

interface PropertyNormalizerInterface
{
    /**
     * @return array<string,array<string,string|null>>
     */
    public function normalizeProperties(mixed $properties): array;
}
