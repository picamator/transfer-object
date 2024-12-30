<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayObjectPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    /**
     * @param array<string|int,mixed> $data
     *
     * @return \ArrayObject<string|int,mixed>
     */
    public function fromArray(mixed $data): ArrayObject
    {
        return new ArrayObject($data);
    }

    /**
     * @param \ArrayObject<string|int,mixed> $data
     *
     * @return array<string|int,mixed>
     */
    public function toArray(mixed $data): array
    {
        return $data->getArrayCopy();
    }
}
