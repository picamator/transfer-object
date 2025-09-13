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
     * Specification:
     * - Recursively converts the transfer object and its nested properties to an associative array.
     * - Preserves the structure of the transfer object while converting it to an array format.
     *
     * @api
     *
     * @return array<string,mixed>
     */
    public function toArray(): array;

    /**
     * Specification:
     * - Converts an array to a transfer object.
     * - Skips data items that do not exist in the transfer object definition.
     *
     * @api
     *
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    public function fromArray(array $data): static;
}
