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
     * - Converts recursively transfer object to array.
     * - Applies a callback to each transfer object property after converting to an array.
     * - The callback works the same way as the PHP function `array_filter()`.
     * - When no callback is supplied, all empty entries will be removed (see PHP function `empty()`).
     *
     * @link https://www.php.net/manual/en/function.array-filter.php
     * @link https://www.php.net/manual/en/function.empty.php
     *
     * @api
     *
     * @param callable|null $callback Optional. A callback function to apply to each property.
     *                                If null, empty entries will be removed.
     * @return array<string,mixed>
     */
    public function toFilterArray(?callable $callback = null): array;

    /**
     * Specification:
     * - Converts an array to a transfer object.
     * - Skips data items that do not exist in the transfer object definition.
     *
     * @api
     *
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    public function fromArray(array $data): static;
}
