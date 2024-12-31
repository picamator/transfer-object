<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use BackedEnum;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class EnumPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private string $typeName)
    {
    }

    /**
     * @param string|int $data
     */
    public function fromArray(mixed $data): ?BackedEnum
    {
        if (!is_string($data) || !is_subclass_of($this->typeName, BackedEnum::class)) {
            return null;
        }

        return $this->typeName::tryFrom($data);
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
