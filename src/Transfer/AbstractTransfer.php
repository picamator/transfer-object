<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use SplFixedArray;
use Traversable;

abstract class AbstractTransfer implements TransferInterface
{
    use PropertyTypeTrait {
        getConstantAttribute as private;
        hasConstantAttribute as private;
    }

    protected const int META_DATA_SIZE = 0;

    protected const array META_DATA = [];

    private const string DATA_INDEX = '_DATA_INDEX';

    /**
     * @var SplFixedArray<mixed>
     */
    protected SplFixedArray $_data;

    final public function __construct()
    {
        $this->initData();
    }

    final public function getIterator(): Traversable
    {
        foreach (static::META_DATA as $metaKey => $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX;

            yield $metaKey => $this->_data[static::{$metaIndex}];
        }
    }

    /**
     * @throws \JsonException
     */
    final public function jsonSerialize(): string
    {
        return json_encode($this->toArray(), flags: JSON_THROW_ON_ERROR);
    }

    final public function serialize(): string
    {
        return serialize($this->_data);
    }

    final public function unserialize(string $data): void
    {
        $this->_data = unserialize($data);
    }

    /**
     * @return array<string,SplFixedArray<mixed>>
     */
    final public function __serialize(): array
    {
        return [
            'data' => $this->_data,
        ];
    }

    /**
     * @param array<string,mixed> $data
     */
    final public function __unserialize(array $data): void
    {
        $this->_data = $data['data'];
    }

    /**
     * @return int
     */
    final public function count(): int
    {
        return static::META_DATA_SIZE;
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
        foreach ($data as $key => $value) {
            $this->{$key} = $this->hasConstantAttribute(static::META_DATA[$key])
                ? $this->getConstantAttribute(static::META_DATA[$key])?->fromArray($value)
                : $value;
        }

        return $this;
    }

    final public function __debugInfo(): array
    {
        return $this->toArray();
    }

    private function initData(): void
    {
        $this->_data = new SplFixedArray(static::META_DATA_SIZE);

        foreach (static::META_DATA as $metaKey => $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX;
            $this->_data[static::{$metaIndex}] = $this->{$metaKey};
        }
    }
}
