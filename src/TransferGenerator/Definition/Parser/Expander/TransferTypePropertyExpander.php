<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\EmbeddedTypeBuilderInterface;

final class TransferTypePropertyExpander extends AbstractPropertyExpander
{
    private const string TYPE_KEY = 'type';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $transferType = $this->getTransferType($propertyType);
        if ($transferType === null) {
            return;
        }

        $propertyTransfer->transferType = $this->typeBuilder->createPrefixTypeTransfer($transferType);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getTransferType(array $propertyType): string|null
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return null;
        }

        return BuildInTypeEnum::tryFrom($type) === null ? $type : null;
    }
}
