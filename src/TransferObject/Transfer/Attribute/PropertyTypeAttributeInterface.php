<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Picamator\TransferObject\Transfer\TransferInterface;

interface PropertyTypeAttributeInterface
{
    /**
     * @return \ArrayObject<\Picamator\TransferObject\Transfer\TransferInterface>|\Picamator\TransferObject\Transfer\TransferInterface
     */
    public function fromArray(array $data): ArrayObject|TransferInterface;

    /**
     * @param \ArrayObject<\Picamator\TransferObject\Transfer\TransferInterface>|\ArrayObject<mixed> $data
     */
    public function toArray(ArrayObject $data): array;

    /**
     * @param \ArrayObject<\Picamator\TransferObject\Transfer\TransferInterface>|\ArrayObject<mixed> $data
     */
    public function toSnakeArray(ArrayObject $data): array;

    /**
     * @param \ArrayObject<\Picamator\TransferObject\Transfer\TransferInterface>|ArrayObject<mixed> $data
     *
     * @return \ArrayObject<\Picamator\TransferObject\Transfer\TransferInterface>|ArrayObject<mixed>
     */
    public function clone(ArrayObject $data): ArrayObject;
}
