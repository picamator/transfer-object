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
     * @var array<string, string>
     */
    protected const array META_INITIATORS = [];

    /**
     * @var array<string, string>
     */
    protected const array META_TRANSFORMERS = [];

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
        $this->initData();

        if ($data !== null) {
            $this->hydrateData($data);
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
            yield $propertyName => $this->_data[$index];
        }
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    final public function __clone(): void
    {
        /** @var \SplFixedArray<mixed> $data */
        $data = unserialize(serialize($this->_data));

        $this->_data = $data;
    }

    final public function toArray(): array
    {
        $data = [];
        $metaData = static::META_DATA;

        foreach (static::META_TRANSFORMERS as $propertyName => $constantName) {
            $index = $metaData[$propertyName];
            $value = $this->_data[$index];

            $data[$propertyName] = $this->getTransformerAttribute($constantName)->toArray($value);
            unset($metaData[$propertyName]);
        }

        foreach ($metaData as $propertyName => $index) {
            $data[$propertyName] = $this->_data[$index];
        }

        return $data;
    }


    final public function fromArray(array $data): static
    {
        $this->initData();

        if ($data !== []) {
            $this->hydrateData($data);
        }

        return $this;
    }

    final protected function getData(int $index): mixed
    {
        return $this->_data[$index];
    }

    final protected function setData(int $index, mixed $value): void
    {
        $this->_data[$index] = $value;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function hydrateData(array $data): void
    {
        $this->filterData($data);

        if ($data === []) {
            return;
        }

        foreach (static::META_TRANSFORMERS as $propertyName => $constantName) {
            if (!isset($data[$propertyName])) {
                continue;
            }

            $index = static::META_DATA[$propertyName];
            $value = $this->getTransformerAttribute($constantName)->fromArray($data[$propertyName]);

            $this->_data[$index] = $value;
            unset($data[$propertyName]);
        }

        foreach ($data as $propertyName => $value) {
            $this->$propertyName = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function filterData(array &$data): void
    {
        foreach ($data as $propertyName => $value) {
            if ($value === null || !isset(static::META_DATA[$propertyName])) {
                unset($data[$propertyName]);
            }
        }
    }

    private function initData(): void
    {
        $this->_data = new SplFixedArray(size: static::META_DATA_SIZE);

        foreach (static::META_INITIATORS as $propertyName => $constantName) {
            $index = static::META_DATA[$propertyName];
            $value = $this->getInitiatorAttribute($constantName)->getInitialValue();

            $this->_data[$index] = $value;
        }
    }
}
