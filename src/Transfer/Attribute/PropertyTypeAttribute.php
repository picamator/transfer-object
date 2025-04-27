<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;
use Picamator\TransferObject\Transfer\TransferInterface;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class PropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): TransferInterface
    {
        if (!is_array($data)) {
            throw new PropertyTypeTransferException(
                sprintf(
                    'Data must be of type array, "%s" given."',
                    get_debug_type($data)
                ),
            );
        }

        /** @var array<string, mixed> $data */
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

    public function getInitialValue(): null
    {
        return null;
    }

    /**
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    private function createTransfer(array $data): TransferInterface
    {
        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        $transfer = new $this->typeName();

        return $transfer->fromArray($data);
    }
}
