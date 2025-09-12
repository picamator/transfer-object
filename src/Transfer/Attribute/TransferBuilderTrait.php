<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferInterface;
use ReflectionClass;

trait TransferBuilderTrait
{
    use DataAssertTrait;

    /**
     * @param class-string $typeName
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    final protected function createTransfer(string $typeName, mixed $data): TransferInterface
    {
        $this->assertArray($data);

        /** @var array<string, mixed> $data */
        $reflection = new ReflectionClass($typeName);

        if (is_subclass_of($typeName, AbstractTransfer::class)) {
            // @phpstan-ignore argument.type, return.type
            return $reflection->newLazyGhost(function (AbstractTransfer $object) use ($data): void {
                $object->__construct($data);
            });
        }

        // @phpstan-ignore argument.type, return.type
        return $reflection->newLazyGhost(function (TransferInterface $object) use ($data): void {
            $object->fromArray($data);
        });
    }
}
