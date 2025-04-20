<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use EmptyIterator;
use Traversable;

/**
 * Specifications:
 * - Provides default (dummy) implementations for methods in transfer object interfaces.
 * - Simplifies integration with external transfer objects by removing the need to implement all interface methods.
 * - Intended for use as a placeholder in cases where full method functionality is not required.
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
        return 0;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [];
    }

    /**
     * @return array<string,mixed>
     */
    public function toFilterArray(?callable $callback = null): array
    {
        return [];
    }

    /**
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
        return [];
    }

    /**
     * @return array<string,mixed>
     */
    public function __serialize(): array
    {
        return [];
    }

    /**
     * @param array<string,mixed> $data
     */
    public function __unserialize(array $data): void
    {
    }
}
