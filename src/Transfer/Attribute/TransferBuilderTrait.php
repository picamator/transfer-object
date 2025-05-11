<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferInterface;

trait TransferBuilderTrait
{
    use DataAssertTrait;

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    final protected function createTransfer(string $typeName, mixed $data): TransferInterface
    {
        $this->assertArray($data);

        /** @var array<string, mixed> $data */
        if (is_subclass_of($typeName, AbstractTransfer::class)) {
            return new $typeName($data);
        }

        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        $transfer = new $typeName();

        return $transfer->fromArray($data);
    }
}
