<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

trait ArrayAssertTrait
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
}
