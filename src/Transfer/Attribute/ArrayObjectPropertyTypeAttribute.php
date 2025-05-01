<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayObjectPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    use DataAssertTrait;

    /**
     * @inheritDoc
     *
     * @return \ArrayObject<string|int,mixed>
     */
    public function fromArray(mixed $data): ArrayObject
    {
        $this->assertArray($data);

        /** @var array<string|int,mixed> $data */
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
