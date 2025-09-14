<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer;

use Generator;
use Picamator\TransferObject\Transfer\Attribute\InitialPropertyTypeAttributeInterface;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface;
use ReflectionAttribute;
use ReflectionClassConstant;
use ReflectionObject;
use WeakReference;

trait ConstantAttributeTrait
{
    /**
     * @var \WeakReference<\ReflectionObject>|null
     */
    private ?WeakReference $_reflectionObjectReference = null;

    /**
     * @return array<string, \Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttributeInterface>
     */
    final protected function getTypeAttributes(): array
    {
        $typeAttributes = [];
        foreach ($this->getReflectionConstants() as $reflectionConstant) {
            $attributeReflections = $reflectionConstant->getAttributes(
                name: PropertyTypeAttributeInterface::class,
                flags: ReflectionAttribute::IS_INSTANCEOF,
            );

            if (!isset($attributeReflections[0])) {
                continue;
            }

            /** @var string $propertyName */
            $propertyName = $reflectionConstant->getValue();
            $typeAttributes[$propertyName] = $attributeReflections[0]->newInstance();
        }

        return $typeAttributes;
    }

    /**
     * @return Generator<string, \Picamator\TransferObject\Transfer\Attribute\InitialPropertyTypeAttributeInterface>
     */
    final protected function getInitialAttributes(): Generator
    {
        foreach ($this->getReflectionConstants() as $reflectionConstant) {
            $attributeReflections = $reflectionConstant->getAttributes(
                name: InitialPropertyTypeAttributeInterface::class,
                flags: ReflectionAttribute::IS_INSTANCEOF,
            );

            if (!isset($attributeReflections[0])) {
                continue;
            }

            /** @var string $propertyName */
            $propertyName = $reflectionConstant->getValue();

            yield $propertyName => $attributeReflections[0]->newInstance();
        }
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
