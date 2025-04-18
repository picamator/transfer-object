<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;
use SplFixedArray;

abstract class AbstractTransfer implements TransferInterface
{
    use AttributeTransferTrait {
        hasConstantAttribute as private;
        getConstantAttribute as private;
    }

    protected const int META_DATA_SIZE = 0;

    protected const array META_DATA = [];

    private const string DATA_INDEX_SUFFIX = '_DATA_INDEX';

    /**
     * @var SplFixedArray<mixed>
     */
    private SplFixedArray $data;

    final public function __construct()
    {
        $this->initData();
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
        return [
            'data' => $this->data,
        ];
    }

    /**
     * @param array<string,mixed> $data
     */
    final public function __unserialize(array $data): void
    {
        $this->data = $data['data'];
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

    /**
     * @throws PropertyTypeTransferException
     */
    final protected function getData(int $index, bool $isRequired): mixed
    {
        if (!$isRequired) {
            return $this->data[$index];
        }

        $data = $this->data[$index];
        if ($data !== null) {
            return $data;
        }

        throw new PropertyTypeTransferException(
            sprintf(
                'Typed property "%s::%s" must not be accessed before initialization.',
                static::class,
                debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'],
            ),
        );
    }

    final protected function setData(int $index, mixed $value): mixed
    {
        return $this->data[$index] = $value;
    }

    final protected function initData(): void
    {
        $this->data = new SplFixedArray(static::META_DATA_SIZE);

        foreach (static::META_DATA as $metaName) {
            $metaIndex = $metaName . self::DATA_INDEX_SUFFIX;
            $initialValue = $this->hasConstantAttribute($metaName)
                ? $this->getConstantAttribute($metaName)?->getInitialValue()
                : null;

            $this->setData(static::{$metaIndex}, $initialValue);
        }
    }
}
