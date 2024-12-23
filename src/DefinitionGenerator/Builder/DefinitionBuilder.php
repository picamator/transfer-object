<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use ArrayObject;
use Generator;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\SupportedBuildInTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\VariableTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\HelperBuilderTransfer;
use Picamator\TransferObject\Generated\HelperContentTransfer;

readonly class DefinitionBuilder implements DefinitionBuilderInterface
{
    use BuilderTrait;
    use TransferTypeTrait;
    use CollectionTransferTypeTrait;

    public function buildDefinitionContents(HelperContentTransfer $helperContentTransfer): Generator
    {
        $builderTransfer = $this->getBuilderTransfer($helperContentTransfer);
        yield $builderTransfer->definitionContent;

        foreach ($builderTransfer->helperContents as $helperContentTransfer) {
            yield from $this->buildDefinitionContents($helperContentTransfer);
        }
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     */
    private function getBuilderTransfer(HelperContentTransfer $helperContentTransfer): HelperBuilderTransfer
    {
        $definitionContentTransfer = new DefinitionContentTransfer();
        $definitionContentTransfer->className = $helperContentTransfer->className;

        /** @var ArrayObject<int,\Picamator\TransferObject\Generated\HelperContentTransfer> $helperContentTransfers */
        $helperContentTransfers = new ArrayObject();
        foreach ($helperContentTransfer->content as $propertyName => $propertyValue) {
            $this->assertPropertyName($propertyName);
            $propertyName = (string)$propertyName;
            $typeEnum = $this->getTypeEnum($propertyName, $propertyValue);

            if ($this->isTransfer($typeEnum, $propertyValue)) {
                $propertyTransfer = $this->createTransferTypePropertyTransfer($propertyName);
                $definitionContentTransfer->properties[] = $propertyTransfer;
                $helperContentTransfers[] = $this->createHelperContentTransfer($propertyTransfer->transferType, $propertyValue);

                continue;
            }

            if ($this->isCollectionTransfer($typeEnum, $propertyValue)) {
                $propertyTransfer = $this->getCollectionTypePropertyTransfer($propertyName);
                $definitionContentTransfer->properties[] = $propertyTransfer;
                $helperContentTransfers[] = $this->createHelperContentTransfer($propertyTransfer->collectionType, $propertyValue[0]);

                continue;
            }

            $definitionContentTransfer->properties[] = $this->getBuildInTypePropertyTransfer($propertyName, $typeEnum, $propertyValue);
        }

        $builderTransfer = new HelperBuilderTransfer();
        $builderTransfer->definitionContent = $definitionContentTransfer;
        $builderTransfer->helperContents = $helperContentTransfers;

        return $builderTransfer;
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
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

        throw new GeneratorTransferException(
            sprintf(
                'Property "%s" type "%s" is not supported.',
                $propertyName,
                get_class($propertyValue),
            ),
        );
    }
}
