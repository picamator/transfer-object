<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use SplFixedArray;
use Traversable;

abstract class AbstractTransfer implements TransferInterface
{
    use AttributeTransferTrait {
        hasConstantAttribute as private;
        getConstantAttribute as private;
    }

    protected const int META_DATA_SIZE = 0;

    /**
     * @var array<string,string>
     */
    protected const array META_DATA = [];

    private const string DATA_INDEX_SUFFIX = '_DATA_INDEX';

    /**
     * @var \SplFixedArray<mixed>
     */
    private SplFixedArray $_data;

    /**
     * @param array<string,mixed> $data
     */
    final public function __construct(array $data = [])
    {
        $this->fromArray($data);
    }

    /**
     * @return array<string,mixed>
     */
    final public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array<string,SplFixedArray<mixed>>
     */
    final public function __serialize(): array
    {
        return ['_data' => $this->_data];
    }

    /**
     * @param array<string,\SplFixedArray<mixed>> $data
     */
    final public function __unserialize(array $data): void
    {
        $this->_data = $data['_data'];
    }

    /**
     * @return int
     */
    final public function count(): int
    {
        return static::META_DATA_SIZE;
    }

    final public function __debugInfo(): array
    {
        return $this->toArray();
    }

    final public function getIterator(): Traversable
    {
        foreach (static::META_DATA as $metaKey => $metaName) {
            yield $metaKey => $this->{$metaKey};
        }
    }

    final public function toArray(): array
    {
        $data = [];
        foreach (static::META_DATA as $metaKey => $metaName) {
            $dataItem = $this->{$metaKey};
            $data[$metaKey] = $this->hasConstantAttribute($metaName)
                ? $this->getConstantAttribute($metaName)?->toArray($dataItem)
                : $dataItem;
        }

        return $data;
    }

    final public function toFilterArray(?callable $callback = null): array
    {
        $data = $this->toArray();

        return $this->filterArrayRecursive($data, $callback);
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     */
    private function filterArrayRecursive(array $data, ?callable $callback = null): array
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

    final public function fromArray(array $data): static
    {
        $this->initData();
        if ($data === []) {
            return $this;
        }

        $data = array_intersect_key($data, static::META_DATA);
        $data = array_filter($data, fn(mixed $item): bool => $item !== null);
        foreach ($data as $key => $value) {
            $this->{$key} = $this->hasConstantAttribute(static::META_DATA[$key])
                ? $this->getConstantAttribute(static::META_DATA[$key])?->fromArray($value)
                : $value;
        }

        return $this;
    }

    private function initData(): void
    {
        $this->_data = new SplFixedArray(static::META_DATA_SIZE);

        foreach (static::META_DATA as $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX_SUFFIX;
            // @phpstan-ignore offsetAssign.dimType
            $this->_data[static::{$metaIndex}] = $this->hasConstantAttribute($metaName)
                ? $this->getConstantAttribute($metaName)?->getInitialValue()
                : null;
        }
    }

    final protected function getData(int $index): mixed
    {
        return $this->_data[$index];
    }

    final protected function setData(int $index, mixed $value): mixed
    {
        return $this->_data[$index] = $value;
    }
}
