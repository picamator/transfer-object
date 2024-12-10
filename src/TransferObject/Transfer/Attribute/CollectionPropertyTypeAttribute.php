<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\TransferInterface;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class CollectionPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(
        private string $typeName,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function fromArray(array $data): ArrayObject|TransferInterface
    {
        $collectionData = array_map($this->createTransfer(...), $data);

        return new ArrayObject($collectionData);
    }

    /**
     * @inheritDoc
     */
    public function toArray(ArrayObject $data): array
    {
        $collection = [];
        foreach ($data as $transfer) {
            $collection[] = $transfer->toArray();
        }

        return $collection;
    }

    public function toSnakeArray(ArrayObject $data): array
    {
        $collection = [];
        foreach ($data as $transfer) {
            $collection[] = $transfer->toSnakeArray();
        }

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function clone(ArrayObject $data): ArrayObject
    {
        $clonedData = new ArrayObject();
        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        foreach ($data as $transfer) {
            $clonedData[] = clone $transfer;
        }

        return $clonedData;
    }

    private function createTransfer(array $data): TransferInterface
    {
        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        $transfer = new $this->typeName();

        return $transfer->fromArray($data);
    }
}
