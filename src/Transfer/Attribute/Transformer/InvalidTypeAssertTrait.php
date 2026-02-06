<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

/**
 * @property string $typeName
 */
trait InvalidTypeAssertTrait
{
    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final protected function assertInvalidType(mixed $data): never
    {
        throw new DataAssertTransferException(
            \sprintf(
                'Data must be of type %s, "%s" given.',
                $this->typeName,
                \get_debug_type($data),
            ),
        );
    }
}
