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
     * - Converts recursively transfer object to array
     *
     * @return array<string,mixed>
     */
    public function toArray(): array;

    /**
     * Specification:
     * - Converts recursively transfer object to array
     * - Applies callback to each transfer object property after converting to array
     * - Callback works the same way as on php function `array_filter()`
     * - When no callback is supplied, all empty entries will be removed, see php function `empty()`
     *
     * @see https://www.php.net/manual/en/function.array-filter.php
     * @see https://www.php.net/manual/en/function.empty.php
     *
     * @return array<string,mixed>
     */
    public function toFilterArray(?callable $callback = null): array;

    /**
     * Specification:
     * - Coverts array to transfer object
     * - Skips data item when they do not exist in the transfer object definition
     *
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    public function fromArray(array $data): static;
}
