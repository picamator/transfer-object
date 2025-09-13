<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

/**
 * @api
 */
interface PropertyTypeAttributeInterface
{
    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     * @throws \ReflectionException
     */
    public function fromArray(mixed $data): mixed;

    public function toArray(mixed $data): mixed;
}
