<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Render;

use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class DefinitionRender implements DefinitionRenderInterface
{
    private const string SCHEMA = <<<'START'
# $schema: https://raw.githubusercontent.com/picamator/transfer-object/refs/heads/main/schema/definition.schema.json


START;

    private const string CLASS_TEMPLATE = <<<'START'
# %s
%s:
START;

    private const string TYPE_TEMPLATE = <<<'START'
  %s:
    type: %s
START;

    private const string COLLECTION_TYPE_TEMPLATE = <<<'START'
  %s:
    collectionType: %s
START;


    private const string DATE_TIME_TYPE_TEMPLATE = <<<'START'
  %s:
    dateTimeType: %s
START;

    public function renderSchema(): string
    {
        return self::SCHEMA;
    }

    public function renderDefinitionContent(DefinitionContentTransfer $contentTransfer): string
    {
        $content = sprintf(self::CLASS_TEMPLATE, $contentTransfer->className, $contentTransfer->className) . PHP_EOL;
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $content .= $this->renderProperty($propertyTransfer);
            $content .= PHP_EOL;
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
                => $this->renderType($propertyTransfer->propertyName, $propertyTransfer->buildInType->value),

            $propertyTransfer->transferType !== null
                => $this->renderType($propertyTransfer->propertyName, $propertyTransfer->transferType->name),

            $propertyTransfer->collectionType !== null
                => $this->renderCollectionType(
                    $propertyTransfer->propertyName,
                    $propertyTransfer->collectionType->name,
                ),

            $propertyTransfer->dateTimeType !== null
                => $this->renderDateTimeType(
                    $propertyTransfer->propertyName,
                    $propertyTransfer->dateTimeType->name,
                ),

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

    private function renderDateTimeType(string $propertyName, string $typeName): string
    {
        return sprintf(self::DATE_TIME_TYPE_TEMPLATE, $propertyName, $typeName);
    }

    private function renderCollectionType(string $propertyName, string $typeName): string
    {
        return sprintf(self::COLLECTION_TYPE_TEMPLATE, $propertyName, $typeName);
    }

    private function renderType(string $propertyName, string $typeName): string
    {
        return sprintf(self::TYPE_TEMPLATE, $propertyName, $typeName);
    }
}
