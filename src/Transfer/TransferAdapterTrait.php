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
            if ($typeReflection === null) {
                $this->$name = $value;

                continue;
            }

            $type = str_replace('?', '', (string)$typeReflection);

            $isArray = is_array($value);
            $isString = is_string($value);
            $isStringOrInt = $isString || is_int($value);

            $this->$name = match (true) {
                $isArray && is_subclass_of($type, AbstractTransfer::class)
                    => new $type($value),

                $isArray && is_subclass_of($type, TransferInterface::class)
                    // @phpstan-ignore argument.type
                    => new $type()->fromArray($value),

                $isArray && $type === ArrayObject::class
                    // @phpstan-ignore argument.type
                    => new ArrayObject($value),

                $isStringOrInt && is_subclass_of($type, BackedEnum::class)
                    // @phpstan-ignore argument.type
                    => $type::tryFrom($value),

                $isString && $type === DateTime::class
                    // @phpstan-ignore argument.type
                    => new DateTime($value),

                $isString && $type === DateTimeImmutable::class
                    // @phpstan-ignore argument.type
                    => new DateTimeImmutable($value),

                $isArray && $type === stdClass::class
                    => (object)$value,

                $isStringOrInt && $this->isBcMathLoaded() && $type === Number::class
                    // @phpstan-ignore argument.type
                    => new Number($value),

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
