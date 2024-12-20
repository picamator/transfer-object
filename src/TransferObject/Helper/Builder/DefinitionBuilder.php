<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Builder;

use ArrayObject;
use Generator;
use Picamator\TransferObject\Definition\Enum\TypeEnum;
use Picamator\TransferObject\Exception\HelperTransferException;
use Picamator\TransferObject\Helper\Enum\VariableTypeEnum;
use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\HelperBuilderTransfer;
use Picamator\TransferObject\Transfer\Generated\HelperContentTransfer;

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
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    private function getBuilderTransfer(HelperContentTransfer $helperContentTransfer): HelperBuilderTransfer
    {
        $definitionContentTransfer = new DefinitionContentTransfer();
        $definitionContentTransfer->className = $helperContentTransfer->className;

        /** @var ArrayObject<int,\Picamator\TransferObject\Transfer\Generated\HelperContentTransfer> $helperContentTransfers */
        $helperContentTransfers = new ArrayObject();
        foreach ($helperContentTransfer->content as $propertyName => $propertyValue) {
            $this->assertPropertyName($propertyName);
            $propertyName = (string)$propertyName;
            $typeEnum = $this->getTypeEnum($propertyName, $propertyValue);

            if ($this->isTransfer($typeEnum, $propertyValue)) {
                $propertyTransfer = $this->createTransferTypePropertyTransfer($propertyName);
                $definitionContentTransfer->properties[] = $propertyTransfer;
                $helperContentTransfers[] = $this->createHelperContentTransfer($propertyTransfer->type, $propertyValue);

                continue;
            }

            if ($this->isCollectionTransfer($typeEnum, $propertyValue)) {
                $propertyTransfer = $this->getCollectionTypePropertyTransfer($propertyName);
                $definitionContentTransfer->properties[] = $propertyTransfer;
                $helperContentTransfers[] = $this->createHelperContentTransfer($propertyTransfer->collectionType, $propertyValue[0]);

                continue;
            }

            $definitionContentTransfer->properties[] = $this->getPrimitiveTypePropertyTransfer($propertyName, $typeEnum, $propertyValue);
        }

        $builderTransfer = new HelperBuilderTransfer();
        $builderTransfer->definitionContent = $definitionContentTransfer;
        $builderTransfer->helperContents = $helperContentTransfers;

        return $builderTransfer;
    }

    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    private function getPrimitiveTypePropertyTransfer(
        string $propertyName,
        VariableTypeEnum $typeEnum,
        mixed $propertyValue,
    ): DefinitionPropertyTransfer {
        $propertyTransfer = new DefinitionPropertyTransfer();
        if ($typeEnum->isNull() || $typeEnum->isString()) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = VariableTypeEnum::string->name;

            return $propertyTransfer;
        }

        if (!$typeEnum->isObject()) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = $typeEnum->name;

            return $propertyTransfer;
        }

        if ($propertyValue instanceof ArrayObject) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeEnum::ARRAY_OBJECT->value;

            return $propertyTransfer;
        }

        if (is_iterable($propertyValue)) {
            $propertyTransfer->propertyName = $propertyName;
            $propertyTransfer->type = TypeEnum::ITERABLE->value;

            return $propertyTransfer;
        }

        throw new HelperTransferException(
            sprintf(
                'Property "%s" type "%s" is not supported.',
                $propertyName,
                get_class($propertyValue),
            ),
        );
    }
}
