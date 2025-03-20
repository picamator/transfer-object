<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

final class MetaConstantsTemplateExpander extends AbstractTemplateExpander
{
    private const string META_CONSTANT_SNAKE_CASE_REGEX = '#(?<!^)[A-Z]#';

    private const string META_CONSTANT_ONLY_UPPER_CASE_REGEX = '#^[A-Z]+$#';

    protected function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    protected function handleExpander(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->metaConstants[$this->getMetaConstant($propertyName)] = $propertyName;
    }

    private function getMetaConstant(string $propertyName): string
    {
        if (preg_match(self::META_CONSTANT_ONLY_UPPER_CASE_REGEX, $propertyName) === 1) {
            return $propertyName;
        }

        /** @var string $propertyName */
        $propertyName = preg_replace(self::META_CONSTANT_SNAKE_CASE_REGEX, '_$0', $propertyName);

        return strtoupper($propertyName);
    }
}
