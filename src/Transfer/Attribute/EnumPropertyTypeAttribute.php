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
     * @param string|int|null $data
     */
    public function fromArray(mixed $data): ?BackedEnum
    {
        if ($data === null || !is_subclass_of($this->typeName, BackedEnum::class)) {
            return null;
        }

        return $this->typeName::tryFrom($data);
    }

    /**
     * @param BackedEnum $data
     */
    public function toArray(mixed $data): string|int
    {
        return $data->value;
    }
}