<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\VariableTypeEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

trait CollectionTransferTypeTrait
{
    protected function isCollectionTransfer(VariableTypeEnum $typeEnum, mixed $propertyValue): bool
    {
        if (!$typeEnum->isArray() || empty($propertyValue)) {
            return false;
        }

        $firstCollectionItem = $propertyValue[0] ?? null;

        return is_array($firstCollectionItem) && key($firstCollectionItem) !== 0;
    }

    protected function getCollectionTypePropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->collectionType = $this->getClassName($propertyName);

        return $propertyTransfer;
    }
}
