<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

readonly class TransferTypePropertyExpander implements PropertyExpanderInterface
{
    use NamespacePropertyExpanderTrait;

    private const string TYPE_KEY = 'type';

    public function isApplicable(array $propertyType): bool
    {
        $type = $this->getType($propertyType);

        return $type !== null && BuildInTypeEnum::tryFrom($type) === null;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $type = $this->getType($propertyType) ?? '';

        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $propertyTransfer->transferType = $typeTransfer;

        if (!$this->isNamespace($type)) {
            $typeTransfer->name = $type . TypePrefixEnum::TRANSFER->value;

            return;
        }

        $namespaceTransfer = $this->createDefinitionNamespaceTransfer($type);

        $typeTransfer->name = $namespaceTransfer->alias ?: $namespaceTransfer->baseName;
        $typeTransfer->namespace = $namespaceTransfer;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getType(array $propertyType): string|null
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;

        return is_string($type) ? $type : null;
    }
}
