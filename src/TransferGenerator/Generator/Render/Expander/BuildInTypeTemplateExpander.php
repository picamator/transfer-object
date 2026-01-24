<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\DocBlockTemplateEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\InitiatorAttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class BuildInTypeTemplateExpander extends AbstractTemplateExpander
{
    use TemplateExpanderTrait;

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->buildInType !== null;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        /** @var \Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer $buildInTypeTransfer */
        $buildInTypeTransfer = $propertyTransfer->buildInType;

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $buildInTypeTransfer->name->value;
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;

        if ($buildInTypeTransfer->name->isArrayObject()) {
            $this->expandArrayObjectType($propertyTransfer, $templateTransfer);

            return;
        }

        if ($buildInTypeTransfer->name->isArray()) {
            $this->expandArrayType($propertyTransfer, $templateTransfer);
        }
    }

    private function expandArrayType(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandInitiatorAttribute(
            propertyTransfer: $propertyTransfer,
            initiatorEnum: InitiatorAttributeEnum::ARRAY,
            templateTransfer: $templateTransfer,
        );

        $this->expandDocBlocs(
            propertyTransfer: $propertyTransfer,
            docBlockEnum: DocBlockTemplateEnum::ARRAY,
            templateTransfer: $templateTransfer,
        );
    }

    private function expandArrayObjectType(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports(BuildInTypeEnum::ARRAY_OBJECT->value, $templateTransfer);

        $this->expandInitiatorAttribute(
            propertyTransfer: $propertyTransfer,
            initiatorEnum: InitiatorAttributeEnum::ARRAY_OBJECT,
            templateTransfer: $templateTransfer,
        );

        $this->expandTransformerAttribute(
            propertyTransfer: $propertyTransfer,
            transformerEnum: TransformerAttributeEnum::ARRAY_OBJECT,
            templateTransfer: $templateTransfer,
        );

        $this->expandDocBlocs(
            propertyTransfer: $propertyTransfer,
            docBlockEnum: DocBlockTemplateEnum::ARRAY_OBJECT,
            templateTransfer: $templateTransfer,
        );
    }

    private function expandDocBlocs(
        DefinitionPropertyTransfer $propertyTransfer,
        DocBlockTemplateEnum $docBlockEnum,
        TemplateTransfer $templateTransfer,
    ): void {
        $docBlock = $propertyTransfer->buildInType?->docBlock;
        $propertyName = $propertyTransfer->propertyName;

        $templateTransfer->docBlocks[$propertyName] = $docBlockEnum->renderTemplate($docBlock);
    }
}
