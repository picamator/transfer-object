<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Attribute;
use BackedEnum;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class EnumTransformerAttribute implements TransformerAttributeInterface
{
    use DataAssertTrait;

    /**
     * @param \BackedEnum|class-string<\BackedEnum> $typeName
     */
    public function __construct(private BackedEnum|string $typeName)
    {
    }

    public function fromArray(mixed $data): ?BackedEnum
    {
        $this->assertStringOrInt($data);

        /**
         * @var string|int $data
         * @var BackedEnum|null $backedEnum
         */
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
}
