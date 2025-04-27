<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use BackedEnum;
use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class EnumPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private BackedEnum|string $typeName)
    {
    }

    public function fromArray(mixed $data): ?BackedEnum
    {
        if (!is_string($data) && !is_int($data)) {
            throw new PropertyTypeTransferException(
                sprintf(
                    'Data must be of type string or integer, "%s" given."',
                    get_debug_type($data)
                ),
            );
        }

        /** @var BackedEnum|null $backedEnum */
        $backedEnum = $this->typeName::tryFrom($data);

        return $backedEnum;
    }

    /**
     * @param BackedEnum|null $data
     */
    public function toArray(mixed $data): string|int|null
    {
        return $data?->value;
    }

    public function getInitialValue(): null
    {
        return null;
    }
}
