<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * @extends \IteratorAggregate<string, mixed>
 */
interface TransferInterface extends IteratorAggregate, JsonSerializable, Countable
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(): array;

    /**
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    public function fromArray(array $data): static;
}
