<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\InitiatorAttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransformerAttributeTemplateEnum;

trait TemplateExpanderTrait
{
    final protected function enforceTransferInterface(string $propertyType): string
    {
        return 'TransferInterface&' . $propertyType;
    }

    final protected function expandImports(string $className, TemplateTransfer $templateTransfer): void
    {
        $templateTransfer->imports[$className] ??= $className;
    }

    final protected function expandEmbeddedType(
        DefinitionPropertyTransfer $propertyTransfer,
        DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $className = $embeddedTypeTransfer->namespace?->fullName ?: '';
        $this->expandImports($className, $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $embeddedTypeTransfer->name;
        $templateTransfer->nullables[$propertyName] = $propertyTransfer->isNullable;
    }

    final protected function expandInitiatorAttribute(
        DefinitionPropertyTransfer $propertyTransfer,
        InitiatorAttributeEnum $initiatorEnum,
        TemplateTransfer $templateTransfer,
    ): void {
        $this->expandImports($initiatorEnum->getImport(), $templateTransfer);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->metaAttributes[$propertyName][] = $initiatorEnum->value;
        $templateTransfer->metaInitiators[] = $propertyName;

        $templateTransfer->nullables[$propertyName] = false;
    }

    /**
     * @param callable(): string|null $renderTemplate
     */
    final protected function expandTransformerAttribute(
        DefinitionPropertyTransfer $propertyTransfer,
        TransformerAttributeEnum|TransformerAttributeTemplateEnum $transformerEnum,
        TemplateTransfer $templateTransfer,
        ?callable $renderTemplate = null,
    ): void {
        $this->expandImports($transformerEnum->getImport(), $templateTransfer);

        $attribute = $renderTemplate === null ? $transformerEnum->value : $renderTemplate();
        $propertyName = $propertyTransfer->propertyName;

        $templateTransfer->metaAttributes[$propertyName][] = $attribute;
        $templateTransfer->metaTransformers[] = $propertyName;
    }
}
