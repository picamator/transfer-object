<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferInterface;
use ReflectionClass;

/**
 * Specification:
 * - Uses lazy loading to postpone initiating embedded transfer objects.
 *
 * @link https://www.php.net/manual/en/language.oop5.lazy-objects.php
 * @link https://wiki.php.net/rfc/lazy-objects
 *
 * @property class-string<\Picamator\TransferObject\Transfer\AbstractTransfer|TransferInterface> $typeName
 */
trait TransferBuilderTrait
{
    use ArrayAssertTrait;

    final protected function createTransfer(mixed $data): TransferInterface
    {
        $this->assertArray($data);

        $reflection = new ReflectionClass($this->typeName);

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
        /** @var TransferInterface $transfer */
        $transfer = $reflection->newLazyGhost(function (TransferInterface $ghost) use ($data): void {
            $ghost->fromArray($data);
        });

        return $transfer;
    }

    /**
     * @param ReflectionClass<AbstractTransfer> $reflection
     * @param array<string, mixed> $data
     */
    private function createLazyAbstractTransfer(ReflectionClass $reflection, array $data): AbstractTransfer
    {
        /** @var AbstractTransfer $transfer */
        $transfer = $reflection->newLazyGhost(function (AbstractTransfer $ghost) use ($data): void {
            $ghost->__construct($data);
        });

        return $transfer;
    }
}
