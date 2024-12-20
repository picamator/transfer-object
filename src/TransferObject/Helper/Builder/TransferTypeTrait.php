<?php declare(strict_types=1);

namespace Picamator\TransferObject\Helper\Builder;

use Picamator\TransferObject\Helper\Enum\VariableTypeEnum;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;

trait TransferTypeTrait
{
    protected function isTransfer(VariableTypeEnum $typeEnum, mixed $propertyValue): bool
    {
        if (!$typeEnum->isArray() || empty($propertyValue)) {
            return false;
        }

        $key = key($propertyValue);

        return is_string($key);
    }

    protected function createTransferTypePropertyTransfer(string $propertyName): DefinitionPropertyTransfer
    {
        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = $propertyName;
        $propertyTransfer->type = $this->getClassName($propertyName);

        return $propertyTransfer;
    }
}
