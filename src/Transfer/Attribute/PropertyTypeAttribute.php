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
     * @param array<string,mixed>|null $data
     */
    public function fromArray(mixed $data): ?TransferInterface
    {
        if ($data === null) {
            return null;
        }

        return $this->createTransfer($data);
    }

    /**
     * @param \Picamator\TransferObject\Transfer\TransferInterface|null $data
     *
     * @return array<int|string,mixed>|null
     */
    public function toArray(mixed $data): ?array
    {
        return $data?->toArray();
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
