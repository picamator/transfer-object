<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Traversable;

/**
 * @phpstan-ignore trait.unused
 */
trait TransferTrait
{
    use AttributeTransferTrait {
        hasConstantAttribute as private;
        getConstantAttribute as private;
    }

    final public function getIterator(): Traversable
    {
        foreach (static::META_DATA as $metaKey => $metaName) {
            yield $metaKey => $this->{$metaKey};
        }
    }

    final public function toArray(): array
    {
        $data = [];
        foreach (static::META_DATA as $metaKey => $metaName) {
            $dataItem = $this->{$metaKey};
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
            $this->{$key} = $this->hasConstantAttribute(static::META_DATA[$key])
                ? $this->getConstantAttribute(static::META_DATA[$key])?->fromArray($value)
                : $value;
        }

        return $this;
    }
}
