<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer;

use Countable;
use IteratorAggregate;
use JsonSerializable;
use Serializable;
use Traversable;

interface TransferInterface extends IteratorAggregate, JsonSerializable, Serializable, Countable
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array;

    /**
     * @param array<string,mixed> $data
     */
    public function fromArray(array $data): static;

    public function toTransfer(TransferInterface $transfer): TransferInterface;

    public function fromTransfer(TransferInterface $transfer): static;
}
