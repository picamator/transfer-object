<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class EnumTypePropertyExpander extends AbstractPropertyExpander
{
    private const string ENUM_TYPE_KEY = 'enumType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function matchType(array $propertyType): ?string
    {
        /** @var string|null $matchType */
        $matchType = $propertyType[self::ENUM_TYPE_KEY] ?? null;

        return $matchType;
    }

    protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->enumType = $this->typeBuilder->createTypeTransfer($matchedType);
    }
}
