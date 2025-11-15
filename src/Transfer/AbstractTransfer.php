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

    private const \Closure FILTER_DATA_CALLBACK = static function (mixed $value): bool {
        return $value !== null;
    };

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
            yield $propertyName => $this->_data[$index];
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
        foreach ($this->getTransformerAttributeReflections() as $propertyName => $reflection) {
            $data[$propertyName] = $reflection->newInstance()->toArray($this->$propertyName);
        }

        $propertyNames = array_diff_key(static::META_DATA, $data);
        $propertyNames = array_keys($propertyNames);
        foreach ($propertyNames as $propertyName) {
            $data[$propertyName] = $this->$propertyName;
        }

        return $data;
    }

    final public function fromArray(array $data): static
    {
        $this->initData();

        $data = array_filter($data, callback: self::FILTER_DATA_CALLBACK);
        $data = array_intersect_key($data, static::META_DATA);
        if ($data === []) {
            return $this;
        }

        foreach ($this->getTransformerAttributeReflections() as $propertyName => $reflection) {
            if (!isset($data[$propertyName])) {
                continue;
            }

            $this->$propertyName = $reflection->newInstance()->fromArray($data[$propertyName]);
            unset($data[$propertyName]);
        }

        foreach ($data as $propertyName => $value) {
            $this->$propertyName = $value;
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

        foreach ($this->getInitiatorAttributes() as $propertyName => $attribute) {
            $this->$propertyName = $attribute->getInitialValue();
        }
    }
}
