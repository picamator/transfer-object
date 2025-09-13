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

    private const string DATA_INDEX_SUFFIX = '_DATA_INDEX';

    /**
     * @var \SplFixedArray<mixed>
     */
    private SplFixedArray $_data;

    /**
     * @param array<string,mixed> $data
     *
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
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

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException
     */
    final public function __clone(): void
    {
        $this->fromArray($this->toArray());
    }

    final public function toArray(): array
    {
        $data = [];
        $attributes = $this->getTypeAttributes();

        foreach (static::META_DATA as $metaKey => $metaName) {
            if (isset($attributes[$metaName])) {
                $data[$metaKey] = $attributes[$metaName]->toArray($this->{$metaKey});

                continue;
            }

            $data[$metaKey] = $this->{$metaKey};
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
        foreach (static::META_DATA as $metaKey => $metaName) {
            if (!isset($data[$metaKey])) {
                continue;
            }

            if (isset($attributes[$metaName])) {
                $this->{$metaKey} = $attributes[$metaName]->fromArray($data[$metaKey]);

                continue;
            }

            $this->{$metaKey} = $data[$metaKey];
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
        $this->_data = new SplFixedArray(static::META_DATA_SIZE);

        foreach ($this->getInitialAttributes() as $metaName => $attribute) {
            $metaIndex = $metaName . self::DATA_INDEX_SUFFIX;
            // @phpstan-ignore offsetAssign.dimType
            $this->_data[static::{$metaIndex}] = $attribute->getInitialValue();
        }
    }
}
