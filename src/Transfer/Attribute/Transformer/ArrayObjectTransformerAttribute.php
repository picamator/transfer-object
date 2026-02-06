<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayObjectTransformerAttribute implements TransformerAttributeInterface
{
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
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    private function assertArray(mixed $data): void
    {
        if (\is_array($data)) {
            return;
        }

        throw new DataAssertTransferException(
            \sprintf(
                'Data must be of type array, "%s" given.',
                \get_debug_type($data),
            ),
        );
    }
}
