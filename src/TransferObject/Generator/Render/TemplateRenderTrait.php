<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use ArrayObject;
use Picamator\TransferObject\Definition\Enum\DefinitionTypeEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\Generator\Enum\ArrayEnum;
use Picamator\TransferObject\Generator\Enum\ArrayObjectEnum;
use Picamator\TransferObject\Generator\Enum\TransferEnum;

trait TemplateRenderTrait
{
    protected const array SORTABLE_PROPERTIES = [
        'imports',
        'metaConstants',
    ];

    protected const array UNIQUE_PROPERTIES = [
        'imports',
    ];

    protected function isArrayObject(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return ArrayObjectEnum::CLASS_NAME->value === $propertyTransfer->type;
    }

    protected function isArray(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return ArrayEnum::TYPE->value === $propertyTransfer->type;
    }

    protected function isTransferType(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return DefinitionTypeEnum::tryFrom($propertyTransfer->type) === null;
    }

    protected function isTransferCollectionType(DefinitionPropertyTransfer $propertyTransfer): bool
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
        return $propertyType . TransferEnum::FILE_NAME_SUFFIX->value;
    }
}
