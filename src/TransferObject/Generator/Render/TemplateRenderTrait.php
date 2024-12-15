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

    protected function sortTemplateTransfer(TemplateTransfer $templateTransfer): void
    {
        foreach ($templateTransfer as $key => $value) {
            if (!$value instanceof ArrayObject) {
                continue;
            }

            $value = $value->getArrayCopy();
            natsort($value);

            $templateTransfer->{$key} = new ArrayObject($value);
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
