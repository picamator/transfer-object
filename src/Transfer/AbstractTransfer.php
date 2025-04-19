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
    protected SplFixedArray $_data;

    final public function __construct()
    {
        $this->initData();
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
        return [
            '_data' => $this->_data,
        ];
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

    final public function fromArray(array $data): static
    {
        $this->initData();

        $data = array_intersect_key($data, static::META_DATA);
        $data = array_filter($data, fn(mixed $item): bool => $item !== null);
        foreach ($data as $key => $value) {
            $this->{$key} = $this->hasConstantAttribute(static::META_DATA[$key])
                ? $this->getConstantAttribute(static::META_DATA[$key])?->fromArray($value)
                : $value;
        }

        return $this;
    }

    final protected function initData(): void
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
}
