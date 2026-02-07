<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use ArrayObject;
use Attribute;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class CollectionTransformerAttribute implements TransformerAttributeInterface
{
    use TransferBuilderTrait;

    /**
     * phpcs:disable Generic.Files.LineLength
     *
     * @param class-string<\Picamator\TransferObject\Transfer\AbstractTransfer|\Picamator\TransferObject\Transfer\TransferInterface> $typeName
     */
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

        /** @var \ArrayObject<string|int,\Picamator\TransferObject\Transfer\TransferInterface> $collection */
        $collection = new ArrayObject();

        /** @var array<string|int, mixed> $data */
        foreach ($data as $key => $item) {
            if ($item === null) {
                continue;
            }

            $collection[$key] = $this->createTransfer($item);
        }

        return $collection;
    }

    /**
     * @param \ArrayObject<string|int, \Picamator\TransferObject\Transfer\TransferInterface> $data
     *
     * @return array<string|int,mixed>
     */
    public function toArray(mixed $data): array
    {
        $collection = [];
        foreach ($data as $key => $transfer) {
            $collection[$key] = $transfer->toArray();
        }

        return $collection;
    }
}
