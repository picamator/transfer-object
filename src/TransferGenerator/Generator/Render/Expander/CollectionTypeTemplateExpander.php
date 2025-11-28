<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\InitiatorAttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DockBlockTemplateEnum;

final class CollectionTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    private const string DOCK_BLOCK_TEMPLATE = '<int,%s>';

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $initiatorEnum = InitiatorAttributeEnum::ARRAY_OBJECT;
        $transformerEnum = TransformerAttributeTemplateEnum::COLLECTION;

        $this->expandImports(BuildInTypeEnum::ARRAY_OBJECT->value, $templateTransfer);
        $this->expandImports($initiatorEnum->getImport(), $templateTransfer);
        $this->expandImports($transformerEnum->getImport(), $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $typeTransfer */
        $typeTransfer = $propertyTransfer->collectionType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->dockBlocks[$propertyName] = $this->getPropertyDockBlock($typeTransfer);
        $templateTransfer->nullables[$propertyName] = false;

        $templateTransfer->metaAttributes[$propertyName] = [
            $initiatorEnum->value,
            $transformerEnum->renderTemplate($typeTransfer),
        ];
    }

    private function getPropertyDockBlock(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        $propertyType = $embeddedTypeTransfer->name;

        if ($embeddedTypeTransfer->namespace !== null) {
            $propertyType = $this->enforceTransferInterface($propertyType);
        }

        $dockBlock = sprintf(self::DOCK_BLOCK_TEMPLATE, $propertyType);

        return DockBlockTemplateEnum::ARRAY_OBJECT->renderTemplate($dockBlock);
    }
}
