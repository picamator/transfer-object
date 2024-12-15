<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Picamator\TransferObject\Transfer\TransferInterface;

interface PropertyTypeAttributeInterface
{
    /**
     * @param array<string,mixed> $data
     *
     * @return \ArrayObject<int,\Picamator\TransferObject\Transfer\TransferInterface>|\Picamator\TransferObject\Transfer\TransferInterface
     */
    public function fromArray(array $data): ArrayObject|TransferInterface;

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\Transfer\TransferInterface>|\ArrayObject<int|string,mixed> $data
     */
    public function toArray(ArrayObject $data): array;

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\Transfer\TransferInterface>|\ArrayObject<int|string,mixed> $data
     *
     * @return \ArrayObject<int,\Picamator\TransferObject\Transfer\TransferInterface>|\ArrayObject<int|string,mixed>
     */
    public function clone(ArrayObject $data): ArrayObject;
}
