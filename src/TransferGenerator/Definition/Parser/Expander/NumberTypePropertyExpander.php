<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class NumberTypePropertyExpander extends AbstractPropertyExpander
{
    private const string NUMBER_TYPE_KEY = 'numberType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function matchType(array $propertyType): ?string
    {
        /** @var string|null $matchType */
        $matchType = $propertyType[self::NUMBER_TYPE_KEY] ?? null;

        return $matchType;
    }

    /**
     * @param string $matchedType
     */
    protected function handleExpander(mixed $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->numberType = $this->typeBuilder->createTypeTransfer($matchedType);
    }
}
