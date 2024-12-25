<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use Picamator\TransferObject\Transfer\TransferInterface;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class PropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private string $typeName)
    {
    }

    /**
     * @param array<string,mixed> $data
     */
    public function fromArray(mixed $data): TransferInterface
    {
        return $this->createTransfer($data);
    }

    /**
     * @param \ArrayObject<string|int,mixed> $data
     *
     * @return array<int|string,mixed>
     */
    public function toArray(mixed $data): array
    {
        return $data->getArrayCopy();
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
