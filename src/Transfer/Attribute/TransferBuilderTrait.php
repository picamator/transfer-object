<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferInterface;
use ReflectionClass;

/**
 * Specification:
 * - Uses lazy loading to postpone initiating embedded transfer objects.
 *
 * @link https://www.php.net/manual/en/language.oop5.lazy-objects.php
 * @link https://wiki.php.net/rfc/lazy-objects
 */
trait TransferBuilderTrait
{
    use DataAssertTrait;

    /**
     * @param class-string<AbstractTransfer|TransferInterface> $typeName
     */
    final protected function createTransfer(string $typeName, mixed $data): TransferInterface
    {
        $this->assertArray($data);

        $reflection = new ReflectionClass($typeName);

        if ($reflection->isSubclassOf(AbstractTransfer::class)) {
            /** @var array<string, mixed> $data */
            return $this->createLazyAbstractTransfer($reflection, $data);
        }

        /** @var array<string, mixed> $data */
        return $this->createLazyTransfer($reflection, $data);
    }

    /**
     * @param ReflectionClass<TransferInterface> $reflection
     * @param array<string, mixed> $data
     */
    private function createLazyTransfer(ReflectionClass $reflection, array $data): TransferInterface
    {
        /**
         * @var TransferInterface $transfer
         * @phpstan-ignore argument.type
         */
        $transfer = $reflection->newLazyGhost(function (TransferInterface $object) use ($data): void {
            $object->fromArray($data);
        });

        return $transfer;
    }

    /**
     * @param ReflectionClass<AbstractTransfer> $reflection
     * @param array<string, mixed> $data
     */
    private function createLazyAbstractTransfer(ReflectionClass $reflection, array $data): TransferInterface
    {
        /**
         * @var TransferInterface $transfer
         * @phpstan-ignore argument.type
         */
        $transfer = $reflection->newLazyGhost(function (AbstractTransfer $object) use ($data): void {
            $object->__construct($data);
        });

        return $transfer;
    }
}
