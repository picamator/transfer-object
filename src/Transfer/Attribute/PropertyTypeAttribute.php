<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\TransferInterface;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class PropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private string $typeName)
    {
    }

    public function fromArray(array $data): ArrayObject|TransferInterface
    {
        return $this->createTransfer($data);
    }

    public function toArray(ArrayObject $data): array
    {
        return $data->getArrayCopy();
    }

    public function clone(ArrayObject $data): ArrayObject
    {
        return clone $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function createTransfer(array $data): TransferInterface
    {
        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        $transfer = new $this->typeName();

        return $transfer->fromArray($data);
    }
}
