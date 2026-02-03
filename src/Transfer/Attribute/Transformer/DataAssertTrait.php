<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

trait DataAssertTrait
{
    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final protected function assertArray(mixed $data): void
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

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final protected function assertInvalidType(mixed $data, string $expectedType): never
    {
        throw new DataAssertTransferException(
            \sprintf(
                'Data must be of type %s, "%s" given.',
                $expectedType,
                \get_debug_type($data),
            ),
        );
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final protected function assertStringOrInt(mixed $data): void
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
