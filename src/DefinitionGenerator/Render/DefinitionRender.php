<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Render;

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

    private const string COLLECTION_TYPE_TEMPLATE =<<<'START'
  %s:
    collectionType: %s
START;

    public function renderDefinitionContent(DefinitionContentTransfer $contentTransfer): string
    {
        $content = sprintf(self::CLASS_TEMPLATE, $contentTransfer->className) . PHP_EOL;
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $content .= match (true) {
                $propertyTransfer->buildInType !== null
                    => sprintf(self::TYPE_TEMPLATE, $propertyTransfer->propertyName, $propertyTransfer->buildInType),
                $propertyTransfer->transferType !== null
                    => sprintf(self::TYPE_TEMPLATE, $propertyTransfer->propertyName, $propertyTransfer->transferType),
                $propertyTransfer->collectionType !== null
                    => sprintf(self::COLLECTION_TYPE_TEMPLATE, $propertyTransfer->propertyName, $propertyTransfer->collectionType),
                default => '',
            } . PHP_EOL;
        }

        return $content . PHP_EOL;
    }
}
