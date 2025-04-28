<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class CollectionPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private string $typeName)
    {
    }

    /**
     * @inheritDoc
     *
     * @return \ArrayObject<string|int,\Picamator\TransferObject\Transfer\TransferInterface>
     */
    public function fromArray(mixed $data): ArrayObject
    {
        if (!is_array($data)) {
            throw new PropertyTypeTransferException(
                sprintf(
                    'Data must be of type array, "%s" given."',
                    get_debug_type($data)
                ),
            );
        }

        /** @phpstan-ignore argument.type */
        $collectionData = array_map($this->createTransfer(...), $data);

        return new ArrayObject($collectionData);
    }

    /**
     * @param \ArrayObject<string|int,TransferInterface> $data
     *
     * @return array<string|int,mixed>
     */
    public function toArray(mixed $data): array
    {
        return array_map(
            fn(TransferInterface $transfer): array => $transfer->toArray(),
            $data->getArrayCopy()
        );
    }

    /**
     * @return \ArrayObject<string|int,mixed>
     */
    public function getInitialValue(): ArrayObject
    {
        return new ArrayObject();
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
