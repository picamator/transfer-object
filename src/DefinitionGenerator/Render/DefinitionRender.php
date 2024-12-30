<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Render;

use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;

readonly class DefinitionRender implements DefinitionRenderInterface
{
    private const string CLASS_TEMPLATE = <<<'START'
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

    public function renderDefinitionContent(DefinitionContentTransfer $contentTransfer): string
    {
        $content = sprintf(self::CLASS_TEMPLATE, $contentTransfer->className) . PHP_EOL;
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $content .= match (true) {
                $propertyTransfer->buildInType !== null
                    => $this->renderType($propertyTransfer->propertyName, $propertyTransfer->buildInType->value),

                $propertyTransfer->transferType !== null
                    => $this->renderType($propertyTransfer->propertyName, $propertyTransfer->transferType),

                $propertyTransfer->collectionType !== null
                    => $this->renderCollectionType($propertyTransfer->propertyName, $propertyTransfer->collectionType),

                default => throw new DefinitionGeneratorException(
                    sprintf(
                        'Failed to build definition content for "%s". Unknown property type.',
                        var_export($contentTransfer, true),
                    ),
                ),
            } . PHP_EOL;
        }

        return $content . PHP_EOL;
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
