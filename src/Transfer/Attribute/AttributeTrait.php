<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Generator;
use Picamator\TransferObject\Transfer\Attribute\Initiator\InitiatorAttributeInterface;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransformerAttributeInterface;
use ReflectionAttribute;
use ReflectionClassConstant;
use ReflectionObject;
use WeakReference;

trait AttributeTrait
{
    /**
     * @var \WeakReference<\ReflectionObject>|null
     */
    private ?WeakReference $_reflectionObjectReference = null;

    /**
     * @param array<string>|null $propertyNames
     *
     * @return Generator<string, TransformerAttributeInterface>
     */
    final protected function getTransformers(?array $propertyNames = null): Generator
    {
        $reflectionConstants = $propertyNames === null
            ? $this->getReflectionConstants()
            : $this->getFilterReflectionConstants($propertyNames);

        foreach ($reflectionConstants as $reflectionConstant) {
            $attributeReflections = $reflectionConstant->getAttributes(
                name: TransformerAttributeInterface::class,
                flags: ReflectionAttribute::IS_INSTANCEOF,
            );

            /** @var \ReflectionAttribute<TransformerAttributeInterface>|null $attributeReflection */
            $attributeReflection = array_first($attributeReflections);
            if ($attributeReflection === null) {
                continue;
            }

            /** @var string $propertyName */
            $propertyName = $reflectionConstant->getValue();

            yield $propertyName => $attributeReflection->newInstance();
        }
    }

    /**
     * @return Generator<string, InitiatorAttributeInterface>
     */
    final protected function getInitiators(): Generator
    {
        /** @var array<string, InitiatorAttributeInterface> $initiators */
        $initiators = [];
        foreach ($this->getReflectionConstants() as $reflectionConstant) {
            $attributeReflections = $reflectionConstant->getAttributes(
                name: InitiatorAttributeInterface::class,
                flags: ReflectionAttribute::IS_INSTANCEOF,
            );

            /** @var \ReflectionAttribute<InitiatorAttributeInterface>|null $attributeReflection */
            $attributeReflection = array_first($attributeReflections);
            if ($attributeReflection === null) {
                continue;
            }

            /** @var string $propertyName */
            $propertyName = $reflectionConstant->getValue();
            $initiatorName = $attributeReflection->getName();

            $initiators[$initiatorName] ??= $attributeReflection->newInstance();

            yield $propertyName => $initiators[$initiatorName];
        }
    }

    /**
     * @param array<string> $propertyNames
     *
     * @return array<\ReflectionClassConstant>
     */
    private function getFilterReflectionConstants(array $propertyNames): array
    {
        $reflectionConstants = $this->getReflectionConstants();
        if (count($propertyNames) === count($reflectionConstants)) {
            return $reflectionConstants;
        }

        $propertyNames = array_flip($propertyNames);

        return array_filter(
            $reflectionConstants,
            /** @phpstan-ignore offsetAccess.invalidOffset */
            fn(ReflectionClassConstant $reflection): bool => isset($propertyNames[$reflection->getValue()]),
        );
    }

    /**
     * @return array<\ReflectionClassConstant>
     */
    private function getReflectionConstants(): array
    {
        $reflectionObject = $this->_reflectionObjectReference?->get();

        if ($reflectionObject === null) {
            $reflectionObject = new ReflectionObject($this);
            $this->_reflectionObjectReference = WeakReference::create($reflectionObject);
        }

        return $reflectionObject->getReflectionConstants(filter: ReflectionClassConstant::IS_PUBLIC);
    }
}
