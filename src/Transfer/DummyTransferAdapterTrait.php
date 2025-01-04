<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use EmptyIterator;
use Traversable;

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
}
