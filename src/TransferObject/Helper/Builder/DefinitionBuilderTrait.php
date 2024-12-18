<?php declare(strict_types=1);

namespace Picamator\TransferObject\Helper\Builder;

trait DefinitionBuilderTrait
{
    protected function getClassName(string $propertyName): string
    {
        $className = ucwords($propertyName, '_');

        return str_replace('_', '', $className);
    }
}
