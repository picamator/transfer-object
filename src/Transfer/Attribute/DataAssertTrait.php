<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;

trait DataAssertTrait
{
    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    final protected function assertArray(mixed $data): void
    {
        if (is_array($data)) {
            return;
        }

        throw new PropertyTypeTransferException(
            sprintf(
                'Data must be of type array, "%s" given.',
                get_debug_type($data)
            ),
        );
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    final protected function assertInvalidType(mixed $data, string $expectedType): never
    {
        throw new PropertyTypeTransferException(
            sprintf(
                'Data must be of type %s, "%s" given.',
                $expectedType,
                get_debug_type($data)
            ),
        );
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    final protected function assertStringOrInt(mixed $data): void
    {
        if (is_string($data) || is_int($data)) {
            return;
        }

        throw new PropertyTypeTransferException(
            sprintf(
                'Data must be of type string or integer, "%s" given.',
                get_debug_type($data)
            ),
        );
    }
}
