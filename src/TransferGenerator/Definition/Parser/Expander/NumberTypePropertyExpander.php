<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\EmbeddedTypeBuilderInterface;

final class NumberTypePropertyExpander extends AbstractPropertyExpander
{
    private const string NUMBER_TYPE_KEY = 'numberType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $numberType = $propertyType[self::NUMBER_TYPE_KEY] ?? null;
        if ($numberType === null) {
            return;
        }

        $propertyTransfer->numberType = $this->typeBuilder->createTypeTransfer($numberType);
    }
}
