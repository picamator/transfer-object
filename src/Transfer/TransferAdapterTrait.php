<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use ArrayObject;
use BackedEnum;
use BcMath\Number;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use stdClass;
use Traversable;

/**
 * Specifications:
 * - Provides implementations for methods in transfer object interfaces.
 * - Simplifies integration with external transfer objects by removing the need to implement all interface methods.
 * - Intended for external transfer objects where data is stored in public properties.
 * - Due to unknown external data transfer objects structure some method might not work as expected.
 *
 * @api
 *
 * @example /doc/samples/try-advanced-transfer-generator.php
 */
trait TransferAdapterTrait
{
    use FilterArrayTrait;

    protected const string DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var array<\ReflectionProperty>
     */
    private array $_propertyCache;

    /**
     * @return Traversable<string, mixed>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->getPublicProperties() as $property) {
            $name = $property->getName();

            yield $name => $this->$name;
        }
    }

    public function count(): int
    {
        return count($this->getPublicProperties());
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $data = [];
        foreach ($this->getPublicProperties() as $property) {
            $name = $property->getName();
            $value = $this->$name;

            $data[$name] =
            match (true) {
                $value instanceof TransferInterface => $value->toArray(),

                $value instanceof ArrayObject => $value->getArrayCopy(),

                $value instanceof DateTimeInterface => $value->format(static::DATE_TIME_FORMAT),

                $value instanceof Number => (string)$value,

                $value instanceof stdClass => (array)$value,

                $value instanceof BackedEnum => $value->value,

                default => $value,
            };
        }

        return $data;
    }

    /**
     * @return array<string,mixed>
     */
    public function toFilterArray(?callable $callback = null): array
    {
        $data = $this->toArray();

        return $this->filterArrayRecursive($data, $callback);
    }

    /**
     * @param array<string,mixed> $data
     */
    public function fromArray(array $data): static
    {
        foreach ($this->getPublicProperties() as $property) {
            $settableType = $property->getSettableType();
            if ($settableType === null) {
                continue;
            }

            $name = $property->getName();
            $value = $data[$name] ?? null;

            if ($value === null && !$settableType->allowsNull()) {
                unset($this->$name);

                continue;
            }

            $propertyType = (string)$settableType;

            $isArray = is_array($value);
            $isString = is_string($value);
            $isStringOrInt = $isString || is_int($value);

            $this->$name = match (true) {
                is_subclass_of($propertyType, AbstractTransfer::class) && $isArray
                    => new $propertyType($value),

                is_subclass_of($propertyType, TransferInterface::class) && $isArray
                    //  @phpstan-ignore argument.type
                    => new $propertyType()->fromArray($value),

                is_subclass_of($propertyType, ArrayObject::class) && $isArray
                    //  @phpstan-ignore argument.type
                    => new ArrayObject($value),

                is_subclass_of($propertyType, DateTime::class) && $isString
                    //  @phpstan-ignore argument.type
                    => new DateTime($value),

                is_subclass_of($propertyType, DateTimeImmutable::class) && $isString
                    //  @phpstan-ignore argument.type
                    => new DateTimeImmutable($value),

                is_subclass_of($propertyType, Number::class) && $isStringOrInt
                    //  @phpstan-ignore argument.type
                    => new Number($value),

                is_subclass_of($propertyType, stdClass::class) && $isArray
                    => (object)$value,

                is_subclass_of($propertyType, BackedEnum::class) && $isStringOrInt
                    //  @phpstan-ignore argument.type
                    => $propertyType::tryFrom($value),

                default => $value,
            };
        }

        return $this;
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __debugInfo(): array
    {
        return $this->toArray();
    }

    public function __clone(): void
    {
        $this->fromArray($this->toArray());
    }

    /**
     * @return array<\ReflectionProperty>
     */
    private function getPublicProperties(): array
    {
        if (isset($this->_propertyCache)) {
            return $this->_propertyCache;
        }

        $reflection = new ReflectionClass($this);

        return $this->_propertyCache = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
    }
}
