<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayObjectPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    /**
     * @inheritDoc
     *
     * @return \ArrayObject<string|int,mixed>
     */
    public function fromArray(mixed $data): ArrayObject
    {
        if (!is_array($data)) {
            throw new PropertyTypeTransferException(
                sprintf(
                    'Data must be of type array, "%s" given."',
                    get_debug_type($data)
                ),
            );
        }

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

    /**
     * @return \ArrayObject<string|int,mixed>
     */
    public function getInitialValue(): ArrayObject
    {
        return new ArrayObject();
    }
}
