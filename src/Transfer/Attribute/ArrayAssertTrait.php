<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;

trait ArrayAssertTrait
{
    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    protected function assertArray(mixed $data): void
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
}
