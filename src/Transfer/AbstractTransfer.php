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
    private SplFixedArray $data;

    final public function __construct()
    {
        $this->initData();
    }

    final public function getIterator(): Traversable
    {
        foreach (static::META_DATA as $metaKey => $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX;

            yield $metaKey => $this->data[static::{$metaIndex}];
        }
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
            'data' => $this->data,
        ];
    }

    /**
     * @param array<string,mixed> $data
     */
    final public function __unserialize(array $data): void
    {
        $this->data = $data['data'];
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
            $metaIndex = $metaName . self::DATA_INDEX;
            $dataItem = $this->getData(static::{$metaIndex});

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
            $value = $this->hasConstantAttribute(static::META_DATA[$key])
                ? $this->getConstantAttribute(static::META_DATA[$key])?->fromArray($value)
                : $value;

            $metaIndex = static::META_DATA[$key] . self::DATA_INDEX;
            $this->setData(static::{$metaIndex}, $value);
        }

        return $this;
    }

    final public function __debugInfo(): array
    {
        return $this->toArray();
    }

    final protected function getData(int $index): mixed
    {
        return $this->data[$index];
    }

    final protected function setData(int $index, mixed $value): mixed
    {
        return $this->data[$index] = $value;
    }

    private function initData(): void
    {
        $this->data = new SplFixedArray(static::META_DATA_SIZE);

        foreach (static::META_DATA as $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX;
            $initialValue = $this->hasConstantAttribute($metaName)
                ? $this->getConstantAttribute($metaName)?->getInitialValue()
                : null;

            $this->setData(static::{$metaIndex}, $initialValue);
        }
    }
}
