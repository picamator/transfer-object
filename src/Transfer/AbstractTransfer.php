<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use SplFixedArray;
use Traversable;

/**
 * @api
 */
abstract class AbstractTransfer implements TransferInterface
{
    use ConstantAttributeTrait;

    /**
     * @var int<0, max>
     */
    protected const int META_DATA_SIZE = 0;

    /**
     * @var array<string>
     */
    protected const array META_DATA = [];

    /**
     * @var \SplFixedArray<mixed>
     */
    private SplFixedArray $_data;

    /**
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
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
        foreach ($this->_data as $index => $value) {
            yield static::META_DATA[$index] => $value;
        }
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final public function __clone(): void
    {
        $this->fromArray($this->toArray());
    }

    final public function toArray(): array
    {
        $data = [];
        $attributes = $this->getTypeAttributes();

        foreach (static::META_DATA as $index => $propertyName) {
            $data[$propertyName] = isset($attributes[$propertyName])
                ? $attributes[$propertyName]->toArray($this->{$propertyName})
                : $this->_data[$index];
        }

        return $data;
    }

    final public function fromArray(array $data): static
    {
        $this->initData();

        if ($data === []) {
            return $this;
        }

        $attributes = $this->getTypeAttributes();
        foreach (static::META_DATA as $propertyName) {
            $value = $data[$propertyName] ?? null;
            if ($value === null) {
                continue;
            }

            $this->{$propertyName} = isset($attributes[$propertyName])
                ? $attributes[$propertyName]->fromArray($value)
                : $value;
        }

        return $this;
    }

    final protected function getData(int $index): mixed
    {
        return $this->_data[$index];
    }

    final protected function setData(int $index, mixed $value): mixed
    {
        return $this->_data[$index] = $value;
    }

    private function initData(): void
    {
        $this->_data = new SplFixedArray(size: static::META_DATA_SIZE);

        /** @var array<string,int> $metaData */
        $metaData = array_flip(static::META_DATA);
        foreach ($this->getInitialAttributes() as $propertyName => $attribute) {
            $this->_data[$metaData[$propertyName]] = $attribute->getInitialValue();
        }
    }
}
