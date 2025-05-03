<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

trait FilterArrayTrait
{
    /**
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     */
    protected function filterArrayRecursive(array $data, ?callable $callback = null): array
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
