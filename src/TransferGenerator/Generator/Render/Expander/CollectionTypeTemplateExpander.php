<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\InitiatorAttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DocBlockTemplateEnum;

final class CollectionTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    private const string DOC_BLOCK_TEMPLATE = '<int,%s>';

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(BuildInTypeEnum::ARRAY_OBJECT->value, $templateTransfer);

        /** @var \Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer $typeTransfer */
        $typeTransfer = $propertyTransfer->collectionType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = BuildInTypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->docBlocks[$propertyName] = $this->getPropertyDocBlock($typeTransfer);

        $this->expandInitiatorAttribute(
            propertyTransfer: $propertyTransfer,
            initiatorEnum: InitiatorAttributeEnum::ARRAY_OBJECT,
            templateTransfer: $templateTransfer,
        );

        $transformerEnum = TransformerAttributeTemplateEnum::COLLECTION;
        $this->expandTransformerAttribute(
            propertyTransfer: $propertyTransfer,
            transformerEnum: $transformerEnum,
            templateTransfer: $templateTransfer,
            renderTemplate: fn(): string => $transformerEnum->renderTemplate($typeTransfer),
        );
    }

    private function getPropertyDocBlock(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        $propertyType = $embeddedTypeTransfer->name;

        if ($embeddedTypeTransfer->namespace !== null) {
            $propertyType = $this->enforceTransferInterface($propertyType);
        }

        $docBlock = sprintf(self::DOC_BLOCK_TEMPLATE, $propertyType);

        return DocBlockTemplateEnum::ARRAY_OBJECT->renderTemplate($docBlock);
    }
}
