<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Render;

use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;

readonly class DefinitionRender implements DefinitionRenderInterface
{
    private const string CLASS_TEMPLATE =<<<'START'
%s:
START;

    private const string TYPE_TEMPLATE =<<<'START'
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
                $propertyTransfer->type !== null => sprintf(self::TYPE_TEMPLATE, $propertyTransfer->propertyName, $propertyTransfer->type),
                $propertyTransfer->collectionType !== null => sprintf(self::COLLECTION_TYPE_TEMPLATE, $propertyTransfer->propertyName, $propertyTransfer->collectionType),
                default => '',
            } . PHP_EOL;
        }

        return $content . PHP_EOL;
    }
}
