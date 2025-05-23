<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

final class TransferTypePropertyExpander extends AbstractPropertyExpander
{
    use NamespacePropertyExpanderTrait;

    private const string TYPE_KEY = 'type';


    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $transferType = $this->getTransferType($propertyType);
        if ($transferType === null) {
            return;
        }

        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $propertyTransfer->transferType = $typeTransfer;

        if (!$this->isNamespace($transferType)) {
            $typeTransfer->name = $transferType . TypePrefixEnum::TRANSFER->value;

            return;
        }

        $namespaceTransfer = $this->createDefinitionNamespaceTransfer($transferType);

        $typeTransfer->name = $namespaceTransfer->alias ?: $namespaceTransfer->baseName;
        $typeTransfer->namespace = $namespaceTransfer;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getTransferType(array $propertyType): string|null
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        $type = is_string($type) ? $type : null;

        return $type !== null && BuildInTypeEnum::tryFrom($type) === null ? $type : null;
    }
}
