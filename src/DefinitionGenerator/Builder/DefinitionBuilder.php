<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use ArrayObject;
use Generator;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\SupportedBuildInTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\VariableTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

readonly class DefinitionBuilder implements DefinitionBuilderInterface
{
    use BuilderTrait;
    use TransferTypeTrait;
    use CollectionTransferTypeTrait;

    public function buildDefinitionContents(DefinitionGeneratorContentTransfer $generatorContentTransfer): Generator
    {
        $builderTransfer = $this->getBuilderTransfer($generatorContentTransfer);
        yield $builderTransfer->definitionContent;

        foreach ($builderTransfer->generatorContents as $generatorContentTransfer) {
            yield from $this->buildDefinitionContents($generatorContentTransfer);
        }
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function getBuilderTransfer(DefinitionGeneratorContentTransfer $generatorContentTransfer): DefinitionBuilderTransfer
    {
        $definitionContentTransfer = new DefinitionContentTransfer();
        $definitionContentTransfer->className = $generatorContentTransfer->className;

        /** @var ArrayObject<int,\Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer> $generatorContentTransfers */
        $generatorContentTransfers = new ArrayObject();
        foreach ($generatorContentTransfer->content as $propertyName => $propertyValue) {
            $this->assertPropertyName($propertyName);
            $propertyName = (string)$propertyName;
            $typeEnum = $this->getTypeEnum($propertyName, $propertyValue);

            if ($this->isTransfer($typeEnum, $propertyValue)) {
                $propertyTransfer = $this->createTransferTypePropertyTransfer($propertyName);
                $definitionContentTransfer->properties[] = $propertyTransfer;
                $generatorContentTransfers[] = $this->createGeneratorContentTransfer($propertyTransfer->transferType, $propertyValue);

                continue;
            }

            if ($this->isCollectionTransfer($typeEnum, $propertyValue)) {
                $propertyTransfer = $this->getCollectionTypePropertyTransfer($propertyName);
                $definitionContentTransfer->properties[] = $propertyTransfer;
                $generatorContentTransfers[] = $this->createGeneratorContentTransfer($propertyTransfer->collectionType, $propertyValue[0]);

                continue;
            }

            $definitionContentTransfer->properties[] = $this->getBuildInTypePropertyTransfer($propertyName, $typeEnum, $propertyValue);
        }

        $builderTransfer = new DefinitionBuilderTransfer();
        $builderTransfer->definitionContent = $definitionContentTransfer;
        $builderTransfer->generatorContents = $generatorContentTransfers;

        return $builderTransfer;
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function getBuildInTypePropertyTransfer(
        string $propertyName,
        VariableTypeEnum $typeEnum,
        mixed $propertyValue,
    ): DefinitionPropertyTransfer {
        $propertyTransfer = new DefinitionPropertyTransfer();
        if ($typeEnum->isNull() || $typeEnum->isString()) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->buildInType = VariableTypeEnum::string->name;

            return $propertyTransfer;
        }

        if (!$typeEnum->isObject()) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->buildInType = $typeEnum->name;

            return $propertyTransfer;
        }

        if ($propertyValue instanceof ArrayObject) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->buildInType = SupportedBuildInTypeEnum::ARRAY_OBJECT->value;

            return $propertyTransfer;
        }

        if (is_iterable($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->buildInType = SupportedBuildInTypeEnum::ITERABLE->value;

            return $propertyTransfer;
        }

        throw new DefinitionGeneratorException(
            sprintf(
                'Property "%s" type "%s" is not supported.',
                $propertyName,
                get_class($propertyValue),
            ),
        );
    }
}
