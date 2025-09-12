<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * @api
 *
 * @property class-string $typeName
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class PropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    use TransferBuilderTrait;

    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): TransferInterface
    {
        return $this->createTransfer($this->typeName, $data);
    }

    /**
     * @param \Picamator\TransferObject\Transfer\TransferInterface|null $data
     *
     * @return array<int|string,mixed>|null
     */
    public function toArray(mixed $data): ?array
    {
        return $data?->toArray();
    }
}
