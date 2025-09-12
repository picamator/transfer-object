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
     * Specification:
     * - Uses lazy loading to postpone initiating embedded transfer objects.
     *
     * @link https://www.php.net/manual/en/language.oop5.lazy-objects.php
     * @link https://wiki.php.net/rfc/lazy-objects
     *
     * @param class-string<AbstractTransfer|TransferInterface> $typeName
     */
    final protected function createTransfer(string $typeName, mixed $data): TransferInterface
    {
        $this->assertArray($data);

        $reflection = new ReflectionClass($typeName);

        if ($reflection->isSubclassOf(AbstractTransfer::class)) {
            /**
             * @var TransferInterface $transfer
             * @var array<string, mixed> $data
             *
             * @phpstan-ignore argument.type
             */
            $transfer = $reflection->newLazyGhost(function (AbstractTransfer $object) use ($data): void {
                $object->__construct($data);
            });

            return $transfer;
        }

        /**
         * @var TransferInterface $transfer
         * @var array<string, mixed> $data
         *
         * @phpstan-ignore argument.type
         */
        $transfer = $reflection->newLazyGhost(function (TransferInterface $object) use ($data): void {
            $object->fromArray($data);
        });

        return $transfer;
    }
}
