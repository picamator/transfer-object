<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Helper;

use Picamator\TransferObject\Generator\Enum\DefinitionKeyEnum;
use Picamator\TransferObject\Generator\Enum\DefinitionTypeEnum;
use Picamator\TransferObject\Generator\Enum\TransferEnum;

trait DefinitionParserTrait
{
    protected function getClassName(array $definition) : string
    {
        return (string)key($definition) . TransferEnum::FILE_NAME_SUFFIX->value;
    }

    protected function getProperties(array $definition) : array
    {
        $properties = current($definition);

        return is_array($properties) ? $properties: [];
    }

    protected function getPropertyType(array $propertyDefinition): string
    {
        return $propertyDefinition[DefinitionKeyEnum::TYPE->value]
            ?? ($propertyDefinition[DefinitionKeyEnum::COLLECTION_TYPE->value] ?? '');
    }

    protected function isPropertyCollection(array $propertyDefinition): bool
    {
        return isset($propertyDefinition[DefinitionKeyEnum::COLLECTION_TYPE->value]);
    }

    protected function isPropertyTransfer(array $propertyDefinition): bool
    {
        $propertyType = $propertyDefinition[DefinitionKeyEnum::TYPE->value] ?? '';

        return DefinitionTypeEnum::tryFrom($propertyType) === null;
    }

    protected function getMetaConstant(string $propertyName): string
    {
        return strtoupper(preg_replace('/([A-Z])/', '_$0', $propertyName));
    }

    protected function getTransferName(string $propertyType): string
    {
        return $propertyType . TransferEnum::FILE_NAME_SUFFIX->value;
    }
}
