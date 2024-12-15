<?php declare(strict_types = 1);

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
    protected SplFixedArray $data;

    public final function __construct()
    {
        $this->initData();
    }

    public final function getIterator(): Traversable
    {
        foreach (static::META_DATA as $metaKey => $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX;

            yield $metaKey => $this->data[static::{$metaIndex}];
        }
    }

    public final function jsonSerialize(): string
    {
        return json_encode($this->toArray(), flags: JSON_THROW_ON_ERROR);
    }

    public final function serialize(): string
    {
        return serialize($this->data);
    }

    public final function unserialize(string $data): void
    {
        $this->data = unserialize($data);
    }

    /**
     * @return array<string,SplFixedArray<mixed>>
     */
    public final function __serialize(): array
    {
        return [
            'data' => $this->data,
        ];
    }

    /**
     * @param array<string,mixed> $data
     */
    public final function __unserialize(array $data): void
    {
        $this->data = $data['data'];
    }

    public final function count(): int
    {
        return static::META_DATA_SIZE;
    }

    public final function toArray(): array
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

    public final function fromArray(array $data): static
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

    public final function toTransfer(TransferInterface $transfer): TransferInterface
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

    public final function fromTransfer(TransferInterface $transfer): static
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

    public final function __clone(): void
    {
        $this->data = clone $this->data;
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

    public final function __debugInfo(): array
    {
        return $this->toArray();
    }

    private function initData(): void
    {
        $this->data = new SplFixedArray(static::META_DATA_SIZE);

        foreach (static::META_DATA as $metaKey => $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX;
            $this->data[static::{$metaIndex}] = $this->{$metaKey};
        }
    }
}
