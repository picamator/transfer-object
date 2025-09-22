<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use ArrayObject;
use BackedEnum;
use BcMath\Number;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use ReflectionObject;
use ReflectionProperty;
use stdClass;
use Traversable;
use WeakReference;

/**
 * Specifications:
 * - Provides implementations for methods in transfer object interfaces.
 * - Simplifies integration with external transfer objects by removing the need to implement all interface methods.
 * - Intended for external transfer objects where:
 *   - data are stored in public properties.
 *   - all properties have default initial value.
 *   - all properties are nullable.
 *
 * @api
 *
 * @example /examples/try-advanced-transfer-generator.php
 */
trait TransferAdapterTrait
{
    protected const string DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var \WeakReference<\ReflectionObject>|null
     */
    private ?WeakReference $_reflectionObjectReference = null;

    /**
     * @return Traversable<string, mixed>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->getPublicProperties() as $reflectionProperty) {
            if (!$reflectionProperty->isInitialized($this)) {
                continue;
            }

            $name = $reflectionProperty->getName();

            yield $name => $this->$name;
        }
    }

    /**
     * @return int<0, max>
     */
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
        foreach ($this->getPublicProperties() as $propertyReflection) {
            if (!$propertyReflection->isInitialized($this)) {
                continue;
            }

            $name = $propertyReflection->getName();
            $value = $this->$name;

            $data[$name] = match (true) {
                $value instanceof TransferInterface => $value->toArray(),

                $value instanceof ArrayObject => $value->getArrayCopy(),

                $value instanceof BackedEnum => $value->value,

                $value instanceof DateTimeInterface => $value->format(static::DATE_TIME_FORMAT),

                $value instanceof stdClass => (array)$value,

                $this->isBcMathLoaded() && $value instanceof Number => (string)$value,

                default => $value,
            };
        }

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    public function fromArray(array $data): static
    {
        foreach ($this->getPublicProperties() as $property) {
            $name = $property->getName();
            $value = $data[$name] ?? null;

            $typeReflection = $property->getType();

            $this->$name = $typeReflection === null || $value === null
                ? $value
                : $this->resolveValue((string)$typeReflection, $value);
        }

        return $this;
    }

    private function resolveValue(string $typeReflection, mixed $value): mixed
    {
        $type = str_replace('?', '', $typeReflection);

        if (is_string($value)) {
            return $this->resolveStringValue($type, $value);
        }

        if (is_int($value)) {
            return $this->resolveIntValue($type, $value);
        }

        if (is_array($value)) {
            return $this->resolveArrayValue($type, $value);
        }

        return $value;
    }

    private function resolveIntValue(string $type, int $value): object|int|null
    {
        if (is_subclass_of($type, BackedEnum::class)) {
            // @phpstan-ignore argument.type
            return $type::tryFrom($value);
        }

        if ($this->isBcMathLoaded() && $type === Number::class) {
            // @phpstan-ignore argument.type
            return new Number($value);
        }

        return $value;
    }

    private function resolveStringValue(string $type, string $value): object|string|null
    {
        if ($type === DateTime::class) {
            // @phpstan-ignore argument.type
            return new DateTime($value);
        }

        if ($type === DateTimeImmutable::class) {
            // @phpstan-ignore argument.type
            return new DateTimeImmutable($value);
        }

        if (is_subclass_of($type, BackedEnum::class)) {
            // @phpstan-ignore argument.type
            return $type::tryFrom($value);
        }

        if ($this->isBcMathLoaded() && $type === Number::class) {
            // @phpstan-ignore argument.type
            return new Number($value);
        }

        return $value;
    }

    /**
     * @param array<string|int, mixed> $value
     *
     * @return object|array<string|int, mixed>
     */
    private function resolveArrayValue(string $type, array $value): object|array
    {
        if (is_subclass_of($type, AbstractTransfer::class)) {
            return new $type($value);
        }

        if (is_subclass_of($type, TransferInterface::class)) {
            /** @var array<string, mixed> $value */
            return new $type()->fromArray($value);
        }

        if ($type === ArrayObject::class) {
            return new ArrayObject($value);
        }

        if ($type === stdClass::class) {
            return (object)$value;
        }

        return $value;
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
        $reflectionObject = $this->_reflectionObjectReference?->get();

        if ($reflectionObject === null) {
            $reflectionObject = new ReflectionObject($this);
            $this->_reflectionObjectReference = WeakReference::create($reflectionObject);
        }

        return $reflectionObject->getProperties(filter: ReflectionProperty::IS_PUBLIC);
    }

    private function isBcMathLoaded(): bool
    {
        return extension_loaded('bcmath');
    }
}
