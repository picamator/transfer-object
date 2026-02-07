<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\Attribute\Initiator\InitiatorAttributeInterface;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransformerAttributeInterface;
use Picamator\TransferObject\Transfer\Exception\AttributeTransferException;
use ReflectionAttribute;
use ReflectionClassConstant;

trait AttributeTrait
{
    /**
     * @var array<string, TransformerAttributeInterface|InitiatorAttributeInterface>
     */
    private static array $_attributeCache = [];

    final protected function getInitiatorAttribute(string $constantName): InitiatorAttributeInterface
    {
        /** @var \ReflectionAttribute<InitiatorAttributeInterface> $reflectionAttribute */
        $reflectionAttribute = $this->getConstantReflection(
            constantName: $constantName,
            attributeName: InitiatorAttributeInterface::class,
        );

        /** @var InitiatorAttributeInterface $attributeInstance */
        $attributeInstance = $this->getAttributeInstance($reflectionAttribute);

        return $attributeInstance;
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\AttributeTransferException
     */
    final protected function getTransformerAttribute(string $constantName): TransformerAttributeInterface
    {
        /** @var \ReflectionAttribute<TransformerAttributeInterface> $reflectionAttribute */
        $reflectionAttribute = $this->getConstantReflection(
            constantName: $constantName,
            attributeName: TransformerAttributeInterface::class,
        );

        /** @var TransformerAttributeInterface $attributeInstance */
        $attributeInstance = $this->getAttributeInstance($reflectionAttribute);

        return $attributeInstance;
    }

    /**
     * @param \ReflectionAttribute<TransformerAttributeInterface|InitiatorAttributeInterface> $reflectionAttribute
     */
    private function getAttributeInstance(
        ReflectionAttribute $reflectionAttribute,
    ): TransformerAttributeInterface|InitiatorAttributeInterface {
        if (\count($reflectionAttribute->getArguments()) !== 0) {
            return $reflectionAttribute->newInstance();
        }

        $attributeName = $reflectionAttribute->getName();
        self::$_attributeCache[$attributeName] ??= $reflectionAttribute->newInstance();

        return self::$_attributeCache[$attributeName];
    }

    /**
     * @return \ReflectionAttribute<TransformerAttributeInterface|InitiatorAttributeInterface>
     */
    private function getConstantReflection(string $constantName, string $attributeName): ReflectionAttribute
    {
        $reflectionConstant = new ReflectionClassConstant($this, $constantName);
        $reflectionAttributes = $reflectionConstant->getAttributes(
            name: $attributeName,
            flags: ReflectionAttribute::IS_INSTANCEOF,
        );

        /** @var \ReflectionAttribute<TransformerAttributeInterface|InitiatorAttributeInterface>|null $firstReflectionAttribute */
        $firstReflectionAttribute = $reflectionAttributes[0] ?? null;
        if ($firstReflectionAttribute === null) {
            throw new AttributeTransferException(
                \sprintf('Constant\'s "%s" attribute "%s" not found.', $constantName, $attributeName),
            );
        }

        return $firstReflectionAttribute;
    }
}
