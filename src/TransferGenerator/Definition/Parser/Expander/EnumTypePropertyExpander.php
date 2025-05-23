<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\EmbeddedTypeBuilderInterface;

final class EnumTypePropertyExpander extends AbstractPropertyExpander
{
    private const string ENUM_TYPE_KEY = 'enumType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $enumType = $propertyType[self::ENUM_TYPE_KEY] ?? null;
        if ($enumType === null) {
            return;
        }

        $propertyTransfer->enumType = $this->typeBuilder->createTypeTransfer($enumType);
    }
}
