<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use ArrayObject;
use Attribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class CollectionPropertyTypeAttribute implements InitialPropertyTypeAttributeInterface
{
    use TransferBuilderTrait;

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
        $this->assertArray($data);

        /**
         * @var array<string|int, mixed> $data
         * @var array<string|int,\Picamator\TransferObject\Transfer\TransferInterface> $collectionData
         */
        $collectionData = array_map(
            fn (mixed $dataItem): TransferInterface => $this->createTransfer($this->typeName, $dataItem),
            $data
        );

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
}
