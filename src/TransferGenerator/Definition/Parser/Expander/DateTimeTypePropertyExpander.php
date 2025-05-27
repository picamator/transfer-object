<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class DateTimeTypePropertyExpander extends AbstractPropertyExpander
{
    private const string DATE_TIME_TYPE_KEY = 'dateTimeType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function matchType(array $propertyType): ?string
    {
        return $propertyType[self::DATE_TIME_TYPE_KEY] ?? null;
    }

    protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->dateTimeType = $this->typeBuilder->createTypeTransfer($matchedType);
    }
}
