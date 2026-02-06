<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Attribute;
use BackedEnum;
use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class EnumTransformerAttribute implements TransformerAttributeInterface
{
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

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    private function assertStringOrInt(mixed $data): void
    {
        if (\is_string($data) || \is_int($data)) {
            return;
        }

        throw new DataAssertTransferException(
            \sprintf(
                'Data must be of type string or integer, "%s" given.',
                \get_debug_type($data),
            ),
        );
    }
}
