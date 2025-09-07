<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Override;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEmbeddedTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DockBlockTemplateEnum;

final class CollectionTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    #[Override]
    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(BuildInTypeEnum::ARRAY_OBJECT, $templateTransfer);
        $this->expandImports(AttributeEnum::COLLECTION_TYPE_ATTRIBUTE, $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer */
        $embeddedTypeTransfer = $propertyTransfer->collectionType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->dockBlocks[$propertyName] = $this->getPropertyDockBlock($embeddedTypeTransfer);
        $templateTransfer->nullables[$propertyName] = false;

        $templateTransfer->attributes[$propertyName]
            = AttributeEmbeddedTemplateEnum::COLLECTION_TYPE_ATTRIBUTE->renderTemplate($embeddedTypeTransfer);
    }

    private function getPropertyDockBlock(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        $propertyType = $embeddedTypeTransfer->name;
        $namespaceTransfer = $embeddedTypeTransfer->namespace;

        if ($namespaceTransfer !== null) {
            $propertyType = $this->enforceTransferInterface($propertyType);
        }

        return sprintf(DockBlockTemplateEnum::COLLECTION->value, $propertyType);
    }
}
