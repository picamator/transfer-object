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
     * @var array<string, InitiatorAttributeInterface>
     */
    private static array $_initiatorAttributeCache = [];

    /**
     * @var array<string, TransformerAttributeInterface>
     */
    private static array $_transformerAttributeCache = [];

    /**
     * @var array<string, TransformerAttributeInterface|InitiatorAttributeInterface>
     */
    private static array $_attributeCache = [];

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\AttributeTransferException
     */
    final protected function getInitiatorAttribute(string $constantName): InitiatorAttributeInterface
    {
        $cacheKey = $this->getCacheKey($constantName);
        if (isset(self::$_initiatorAttributeCache[$cacheKey])) {
            return self::$_initiatorAttributeCache[$cacheKey];
        }

        /** @var \ReflectionAttribute<InitiatorAttributeInterface> $reflectionAttribute */
        $reflectionAttribute = $this->getConstantReflection(
            constantName: $constantName,
            attributeName: InitiatorAttributeInterface::class
        );

        /** @var InitiatorAttributeInterface $attributeInstance */
        $attributeInstance = $this->getAttributeInstance($reflectionAttribute);
        self::$_initiatorAttributeCache[$cacheKey] = $attributeInstance;

        return self::$_initiatorAttributeCache[$cacheKey];
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\AttributeTransferException
     */
    final protected function getTransformerAttribute(string $constantName): TransformerAttributeInterface
    {
        $cacheKey = $this->getCacheKey($constantName);
        if (isset(self::$_transformerAttributeCache[$cacheKey])) {
            return self::$_transformerAttributeCache[$cacheKey];
        }

        /** @var \ReflectionAttribute<TransformerAttributeInterface> $reflectionAttribute */
        $reflectionAttribute = $this->getConstantReflection(
            constantName: $constantName,
            attributeName: TransformerAttributeInterface::class
        );

        /** @var TransformerAttributeInterface $attributeInstance */
        $attributeInstance = $this->getAttributeInstance($reflectionAttribute);
        self::$_transformerAttributeCache[$cacheKey] = $attributeInstance;

        return self::$_transformerAttributeCache[$cacheKey];
    }

    /**
     * @param \ReflectionAttribute<TransformerAttributeInterface|InitiatorAttributeInterface> $reflectionAttribute
     */
    private function getAttributeInstance(
        ReflectionAttribute $reflectionAttribute,
    ): TransformerAttributeInterface|InitiatorAttributeInterface {
        if (count($reflectionAttribute->getArguments()) !== 0) {
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
        $firstReflectionAttribute = array_first($reflectionAttributes);
        if ($firstReflectionAttribute === null) {
            throw new AttributeTransferException(
                sprintf('Constant\'s "%s" attribute "%s" not found.', $constantName, $attributeName),
            );
        }

        return $firstReflectionAttribute;
    }

    private function getCacheKey(string $constantName): string
    {
        return static::class . '::' . $constantName;
    }
}
