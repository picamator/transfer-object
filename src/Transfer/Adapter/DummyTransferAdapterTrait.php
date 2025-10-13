<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Adapter;

use EmptyIterator;
use Traversable;

/**
 * Specifications:
 * - Provides default (fake) implementations for methods in transfer object interfaces.
 * - Simplifies integration with external transfer objects by removing the need to implement all interface methods.
 * - Intended as a placeholder in cases where full method functionality is not required.
 *
 * @api
 *
 * @example /examples/try-advanced-transfer-generator.php
 */
trait DummyTransferAdapterTrait
{
    /**
     * @return Traversable<string, mixed>
     */
    public function getIterator(): Traversable
    {
        return new EmptyIterator();
    }

    public function count(): int
    {
        return iterator_count($this);
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [];
    }

    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     *
     * @param array<string,mixed> $data
     */
    public function fromArray(array $data): static
    {
        return $this;
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __debugInfo(): array
    {
        return $this->toArray();
    }
}
