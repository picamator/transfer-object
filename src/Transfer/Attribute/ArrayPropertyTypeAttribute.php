<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    /**
     * @param array<string|int,mixed> $data
     *
     * @return array<string|int,mixed>
     */
    public function fromArray(mixed $data): array
    {
        return $data;
    }

    /**
     * @param array<string|int,mixed> $data
     *
     * @return array<string|int,mixed>
     */
    public function toArray(mixed $data): array
    {
        return $data;
    }

    /**
     * @return array<string|int,mixed>
     */
    public function getInitialValue(): array
    {
        return [];
    }
}
