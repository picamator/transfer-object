<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

trait TemplateRenderTrait
{
    protected const string FILE_NAME_SUFFIX = 'Transfer';

    protected const array SORTABLE_PROPERTIES = [
        'imports',
        'metaConstants',
    ];

    protected const array UNIQUE_PROPERTIES = [
        'imports',
    ];

    protected function isCollectionType(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    protected function sortAndUnify(TemplateTransfer $templateTransfer): void
    {
        foreach (static::SORTABLE_PROPERTIES as $property) {
            /** @var \ArrayObject<int|string,string> $value */
            $value = $templateTransfer->{$property};
            $value = $value->getArrayCopy();

            if (in_array($property,static::UNIQUE_PROPERTIES, true)) {
                $value = array_unique($value);
            }

            natsort($value);

            $templateTransfer->{$property} = new ArrayObject($value);
        }
    }

    protected function getMetaConstant(string $propertyName): string
    {
        return strtoupper(preg_replace('/([A-Z])/', '_$0', $propertyName));
    }

    protected function getTransferName(string $propertyType): string
    {
        return $propertyType . static::FILE_NAME_SUFFIX;
    }
}
