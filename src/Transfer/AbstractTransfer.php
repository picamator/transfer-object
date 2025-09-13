<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Deprecated;
use SplFixedArray;
use Traversable;

/**
 * @api
 */
abstract class AbstractTransfer implements TransferInterface
{
    use FilterArrayTrait;
    use ConstantAttributeTrait;

    protected const int META_DATA_SIZE = 0;

    /**
     * @var array<string,string>
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
        foreach (static::META_DATA as $propertyName) {
            yield $propertyName => $this->{$propertyName};
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

        foreach (static::META_DATA as $propertyName) {
            if (isset($attributes[$propertyName])) {
                $data[$propertyName] = $attributes[$propertyName]->toArray($this->{$propertyName});

                continue;
            }

            $data[$propertyName] = $this->{$propertyName};
        }

        return $data;
    }

    #[Deprecated(message: 'Method will be removed in version 3.0.0. Use FilterArrayTrait instead.', since: '2.3.0')]
    final public function toFilterArray(?callable $callback = null): array
    {
        $data = $this->toArray();

        return $this->filterArrayRecursive($data, $callback);
    }

    final public function fromArray(array $data): static
    {
        $this->initData();

        if ($data === []) {
            return $this;
        }

        $attributes = $this->getTypeAttributes();
        foreach (static::META_DATA as $propertyName) {
            if (!isset($data[$propertyName])) {
                continue;
            }

            if (isset($attributes[$propertyName])) {
                $this->{$propertyName} = $attributes[$propertyName]->fromArray($data[$propertyName]);

                continue;
            }

            $this->{$propertyName} = $data[$propertyName];
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

        /** @var array<string, int> $metaData */
        $metaData = array_flip(static::META_DATA);
        foreach ($this->getInitialAttributes() as $propertyName => $attribute) {
            $this->_data[$metaData[$propertyName]] = $attribute->getInitialValue();
        }
    }
}
