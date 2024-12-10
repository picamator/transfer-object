<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer;

use Countable;
use IteratorAggregate;
use JsonSerializable;
use Serializable;

interface TransferInterface extends IteratorAggregate, JsonSerializable, Serializable, Countable
{
    public function toArray(): array;

    public function fromArray(array $data): static;

    public function toTransfer(TransferInterface $transfer): TransferInterface;

    public function fromTransfer(TransferInterface $transfer): static;
}
