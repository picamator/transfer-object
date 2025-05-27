<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class TypePropertyExpander extends AbstractPropertyExpander
{
    private const string TYPE_KEY = 'type';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function matchType(array $propertyType): ?string
    {
        return $propertyType[self::TYPE_KEY] ?? null;
    }

    protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $buildInType = BuildInTypeEnum::tryFrom($matchedType);
        if ($buildInType !== null) {
            $propertyTransfer->buildInType = $buildInType;

            return;
        }

        $propertyTransfer->transferType = $this->typeBuilder->createPrefixTypeTransfer($matchedType);
    }
}
