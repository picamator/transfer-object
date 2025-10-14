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
     * @return array<string, \Picamator\TransferObject\Transfer\Attribute\Transformer\TransformerAttributeInterface>
     */
    final protected function getTransformerAttributes(): array
    {
        $attributes = [];
        foreach ($this->getReflectionConstants() as $reflectionConstant) {
            $attributeReflections = $reflectionConstant->getAttributes(
                name: TransformerAttributeInterface::class,
                flags: ReflectionAttribute::IS_INSTANCEOF,
            );

            if (!isset($attributeReflections[0])) {
                continue;
            }

            /** @var string $propertyName */
            $propertyName = $reflectionConstant->getValue();
            $attributes[$propertyName] = $attributeReflections[0]->newInstance();
        }

        return $attributes;
    }

    /**
     * @return Generator<string, \Picamator\TransferObject\Transfer\Attribute\Initiator\InitiatorAttributeInterface>
     */
    final protected function getInitiatorAttributes(): Generator
    {
        foreach ($this->getReflectionConstants() as $reflectionConstant) {
            $attributeReflections = $reflectionConstant->getAttributes(
                name: InitiatorAttributeInterface::class,
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
