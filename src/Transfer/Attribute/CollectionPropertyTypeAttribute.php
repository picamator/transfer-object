<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\TransferInterface;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class CollectionPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private string $typeName)
    {
    }

    /**
     * @return \ArrayObject<string,\Picamator\TransferObject\Transfer\TransferInterface>
     */
    public function fromArray(array $data): ArrayObject
    {
        $collectionData = array_map($this->createTransfer(...), $data);

        return new ArrayObject($collectionData);
    }

    public function toArray(ArrayObject $data): array
    {
        $collection = [];
        foreach ($data as $transfer) {
            $collection[] = $transfer->toArray();
        }

        return $collection;
    }

    /**
     * @return \ArrayObject<int,\Picamator\TransferObject\Transfer\TransferInterface>
     */
    public function clone(ArrayObject $data): ArrayObject
    {
        /** @var \ArrayObject<int,\Picamator\TransferObject\Transfer\TransferInterface> $clonedData */
        $clonedData = new ArrayObject();

        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        foreach ($data as $transfer) {
            $clonedData[] = clone $transfer;
        }

        return $clonedData;
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
