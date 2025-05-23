<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\EmbeddedTypeBuilderInterface;

final class DateTimeTypePropertyExpander extends AbstractPropertyExpander
{
    private const string DATE_TIME_TYPE_KEY = 'dateTimeType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $dateTimeType = $propertyType[self::DATE_TIME_TYPE_KEY] ?? null;
        if ($dateTimeType === null) {
            return;
        }

        $propertyTransfer->dateTimeType = $this->typeBuilder->createTypeTransfer($dateTimeType);
    }
}
