<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Filter;

/**
 * @api
 */
trait FilterArrayTrait
{
    /**
     * Specification:
     *  - Applies recursively a callback to each array's value.
     *  - The callback works the same way as the PHP function `array_filter()`.
     *  - When no callback is supplied, all empty entries will be removed (see PHP function `empty()`).
     *
     * @link https://www.php.net/manual/en/function.array-filter.php
     * @link https://www.php.net/manual/en/function.empty.php
     *
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     */
    final protected function filterArrayRecursive(array $data, ?callable $callback = null): array
    {
        /** @var array<string,mixed> $filteredData */
        $filteredData = array_filter($data, $callback);
        foreach ($filteredData as $key => $item) {
            if (is_array($item)) {
                /** @var array<string,mixed> $item */
                $filteredData[$key] = $this->filterArrayRecursive($item, $callback);

                continue;
            }

            $filteredData[$key] = $item;
        }

        return $filteredData;
    }
}
