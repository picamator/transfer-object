<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface;
use ReflectionAttribute;
use ReflectionClassConstant;
use SplFixedArray;
use Traversable;

/**
 * @api
 */
abstract class AbstractTransfer implements TransferInterface
{
    use FilterArrayTrait;

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
        foreach (static::META_DATA as $metaKey => $metaName) {
            $dataItem = $this->{$metaKey};
            $attribute = $this->getConstantAttribute($metaName);

            $data[$metaKey] = $attribute !== null ? $attribute->toArray($dataItem) : $dataItem;
        }

        return $data;
    }

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

        foreach (static::META_DATA as $metaKey => $metaName) {
            if (!isset($data[$metaKey])) {
                continue;
            }

            $attribute = $this->getConstantAttribute($metaName);
            $this->{$metaKey} = $attribute !== null ? $attribute->fromArray($data[$metaKey]) : $data[$metaKey];
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

    private function getConstantAttribute(string $constantName): ?PropertyTypeAttributeInterface
    {
        $reflection = new ReflectionClassConstant($this, $constantName);
        $attributeReflections = $reflection->getAttributes(
            name: PropertyTypeAttributeInterface::class,
            flags: ReflectionAttribute::IS_INSTANCEOF
        );

        $attributeReflection = $attributeReflections[0] ?? null;

        return $attributeReflection?->newInstance();
    }

    private function initData(): void
    {
        $this->_data = new SplFixedArray(static::META_DATA_SIZE);

        foreach (static::META_DATA as $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX_SUFFIX;
            // @phpstan-ignore offsetAssign.dimType
            $this->_data[static::{$metaIndex}] = $this->getConstantAttribute($metaName)?->getInitialValue();
        }
    }
}
