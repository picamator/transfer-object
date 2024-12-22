<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use ArrayObject;
use SplFixedArray;
use Traversable;

abstract class AbstractTransfer implements TransferInterface
{
    use PropertyTypeTrait;

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

            $data[$metaKey] = match(true) {
                $dataItem instanceof TransferInterface => $dataItem->toArray(),
                $dataItem instanceof ArrayObject => $this
                    ->getPropertyTypeAttribute(className: static::class, constantName: $metaName)?->toArray($dataItem)
                    ?? $dataItem,
                $dataItem instanceof Traversable => iterator_to_array($dataItem),
                default => $dataItem,
            };
        }

        return $data;
    }

    final public function fromArray(array $data): static
    {
        $this->initData();
        foreach ($data as $key => $value) {
            if (!isset(static::META_DATA[$key])) {
                continue;
            }

            $this->{$key} = $this
                ->getPropertyTypeAttribute(className: static::class, constantName: static::META_DATA[$key])?->fromArray($value)
                ?? $value;
        }

        return $this;
    }

    final public function toTransfer(TransferInterface $transfer): TransferInterface
    {
        foreach ($this as $key => $dataItem) {
            if (!property_exists($transfer, $key)) {
                continue;
            }

            $metaName = static::META_DATA[$key];
            $transfer->{$key} = match(true) {
                $dataItem instanceof ArrayObject => $this
                    ->getPropertyTypeAttribute(className: static::class, constantName: $metaName)?->clone($dataItem)
                    ?? clone $dataItem,
                is_object($dataItem) => clone $dataItem,
                default => $dataItem,
            };
        }

        return $transfer;
    }

    final public function fromTransfer(TransferInterface $transfer): static
    {
        $this->initData();
        foreach ($transfer as $key => $dataItem) {
            if (!property_exists($this, $key)) {
                continue;
            }

            $metaName = static::META_DATA[$key];
            $this->{$key} = match(true) {
                $dataItem instanceof ArrayObject => $this
                    ->getPropertyTypeAttribute(className: $transfer::class, constantName: $metaName)?->clone($dataItem)
                    ?? clone $dataItem,
                is_object($dataItem) => clone $dataItem,
                default => $dataItem,
            };
        }

        return $this;
    }

    final public function __clone(): void
    {
        $this->_data = clone $this->_data;
        foreach (static::META_DATA as $key => $metaName) {
            $dataItem = $this->{$key};
            if (!is_object($dataItem)) {
                continue;
            }

            $this->{$key} = match(true) {
                $dataItem instanceof ArrayObject => $this
                    ->getPropertyTypeAttribute(className: static::class, constantName: $metaName)?->clone($dataItem) ?? clone $dataItem,
                default => clone $dataItem,
            };
        }
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
