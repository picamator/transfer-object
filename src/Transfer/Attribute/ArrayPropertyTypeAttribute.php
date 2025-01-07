<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    /**
     * @return array<string|int,mixed>
     */
    public function fromArray(mixed $data): array
    {
        if (!is_array($data)) {
            throw new PropertyTypeTransferException(
                sprintf(
                    'Data must be of type array, "%s" given."',
                    gettype($data)
                ),
            );
        }

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
