<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Picamator\TransferObject\Transfer\Attribute\AttributeTrait;
use SplFixedArray;
use Traversable;

/**
 * @api
 */
abstract class AbstractTransfer implements TransferInterface
{
    use AttributeTrait;

    /**
     * @var int<0, max>
     */
    protected const int META_DATA_SIZE = 0;

    /**
     * @var array<string, int>
     */
    protected const array META_DATA = [];

    /**
     * @var \SplFixedArray<mixed>
     */
    private SplFixedArray $_data;

    /**
     * @param array<string,mixed>|null $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final public function __construct(?array $data = null)
    {
        if ($data === null) {
            $this->initData();

            return;
        }

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
        foreach (static::META_DATA as $propertyName => $index) {
            yield $propertyName => $this->_data->offsetGet($index);
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
        foreach ($this->getTransformers() as $propertyName => $transformer) {
            $index = static::META_DATA[$propertyName];
            $data[$propertyName] = $transformer->toArray($this->getData($index));
        }

        if (count($data) === static::META_DATA_SIZE) {
            return $data;
        }

        foreach (static::META_DATA as $propertyName => $index) {
            $data[$propertyName] ??= $this->getData($index);
        }

        return $data;
    }

    final public function fromArray(array $data): static
    {
        $this->initData();

        $filterCallback = fn(mixed $value, int|string $key): bool => $value !== null && isset(static::META_DATA[$key]);
        $data = array_filter($data, callback: $filterCallback, mode: ARRAY_FILTER_USE_BOTH);

        if ($data === []) {
            return $this;
        }

        $propertyNames = array_keys($data);
        foreach ($this->getTransformers($propertyNames) as $propertyName => $transformer) {
            $value = $data[$propertyName];
            $index = static::META_DATA[$propertyName];

            $this->setData($index, $transformer->fromArray($value));

            unset($data[$propertyName]);
        }

        foreach ($data as $propertyName => $value) {
            $this->$propertyName = $value;
        }

        return $this;
    }

    final protected function getData(int $index): mixed
    {
        return $this->_data->offsetGet($index);
    }

    final protected function setData(int $index, mixed $value): mixed
    {
        $this->_data->offsetSet($index, $value);

        return $value;
    }

    private function initData(): void
    {
        $this->_data = new SplFixedArray(size: static::META_DATA_SIZE);

        foreach ($this->getInitiators() as $propertyName => $initiator) {
            $index = static::META_DATA[$propertyName];
            $this->setData($index, $initiator->getInitialValue());
        }
    }
}
