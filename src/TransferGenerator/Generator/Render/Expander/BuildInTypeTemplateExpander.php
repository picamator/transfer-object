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
        $initiatorEnum = InitiatorAttributeEnum::ARRAY;

        $this->expandImports($initiatorEnum->getImport(), $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->metaAttributes[$propertyName] = [
            $initiatorEnum->value,
        ];

        $templateTransfer->metaInitiators[] = $propertyName;

        $templateTransfer->docBlocks[$propertyName]
            = DocBlockTemplateEnum::ARRAY->renderTemplate($propertyTransfer->buildInType?->docBlock);

        $templateTransfer->nullables[$propertyName] = false;
    }

    private function expandArrayObjectType(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $initiatorEnum = InitiatorAttributeEnum::ARRAY_OBJECT;
        $transformerEnum = TransformerAttributeEnum::ARRAY_OBJECT;

        $this->expandImports(BuildInTypeEnum::ARRAY_OBJECT->value, $templateTransfer);
        $this->expandImports($initiatorEnum->getImport(), $templateTransfer);
        $this->expandImports($transformerEnum->getImport(), $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->metaAttributes[$propertyName] = [
            $initiatorEnum->value,
            $transformerEnum->value,
        ];

        $templateTransfer->metaInitiators[] = $propertyName;
        $templateTransfer->metaTransformers[] = $propertyName;

        $templateTransfer->docBlocks[$propertyName]
            = DocBlockTemplateEnum::ARRAY_OBJECT->renderTemplate($propertyTransfer->buildInType?->docBlock);

        $templateTransfer->nullables[$propertyName] = false;
    }
}
