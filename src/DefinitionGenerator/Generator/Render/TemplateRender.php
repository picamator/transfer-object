<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Render;

use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class TemplateRender implements TemplateRenderInterface
{
    private const string SCHEMA = <<<'TEMPLATE'
# $schema: https://raw.githubusercontent.com/picamator/transfer-object/main/schema/definition.schema.json


TEMPLATE;

    private const string CLASS_TEMPLATE = <<<'TEMPLATE'
# %1$s
%1$s:

TEMPLATE;

    private const string TYPE_TEMPLATE = <<<'TEMPLATE'
  %s:
    type: %s

TEMPLATE;

    private const string TYPE_WITH_DOC_BLOCK_TEMPLATE = <<<'TEMPLATE'
  %s:
    type: %s%s

TEMPLATE;

    private const string COLLECTION_TYPE_TEMPLATE = <<<'TEMPLATE'
  %s:
    collectionType: %s

TEMPLATE;

    private const string DATE_TIME_TYPE_TEMPLATE = <<<'TEMPLATE'
  %s:
    dateTimeType: %s

TEMPLATE;

    public function renderSchema(): string
    {
        return self::SCHEMA;
    }

    public function renderContent(DefinitionContentTransfer $contentTransfer): string
    {
        $content = sprintf(self::CLASS_TEMPLATE, $contentTransfer->className);
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $content .= $this->renderProperty($propertyTransfer);
        }

        $content .= PHP_EOL;

        return $content;
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function renderProperty(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return match (true) {
            $propertyTransfer->buildInType !== null
                => $this->renderBuildInType($propertyTransfer),

            $propertyTransfer->transferType !== null
                => $this->renderTransferType($propertyTransfer),

            $propertyTransfer->collectionType !== null
                => $this->renderCollectionType($propertyTransfer),

            $propertyTransfer->dateTimeType !== null
                => $this->renderDateTimeType($propertyTransfer),

            default => $this->renderDefault($propertyTransfer),
        };
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function renderDefault(DefinitionPropertyTransfer $propertyTransfer): never
    {
        throw new DefinitionGeneratorException(
            sprintf(
                'Failed to build definition content for "%s". Unknown property type render.',
                $propertyTransfer->propertyName,
            ),
        );
    }

    private function renderDateTimeType(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::DATE_TIME_TYPE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->dateTimeType?->name ?: '',
        );
    }

    private function renderCollectionType(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::COLLECTION_TYPE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->collectionType?->name ?: '',
        );
    }

    private function renderTransferType(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::TYPE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->transferType?->name ?: '',
        );
    }

    private function renderBuildInType(DefinitionPropertyTransfer $propertyTransfer): string
    {
        /** @var \Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer $buildInType */
        $buildInType = $propertyTransfer->buildInType;

        return $buildInType->docBlock
            ? sprintf(
                self::TYPE_WITH_DOC_BLOCK_TEMPLATE,
                $propertyTransfer->propertyName,
                $buildInType->name->value,
                $buildInType->docBlock,
            )
            : sprintf(
                self::TYPE_TEMPLATE,
                $propertyTransfer->propertyName,
                $buildInType->name->value,
            );
    }
}
