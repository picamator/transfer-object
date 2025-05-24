<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\EmbeddedTypeBuilderInterface;

final class TypePropertyExpander extends AbstractPropertyExpander
{
    private const string TYPE_KEY = 'type';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $type = $propertyType[self::TYPE_KEY] ?? null;
        if ($type === null) {
            return;
        }

        $buildInType = BuildInTypeEnum::tryFrom($type);
        if ($buildInType !== null) {
            $propertyTransfer->buildInType = $buildInType;

            return;
        }

        $propertyTransfer->transferType = $this->typeBuilder->createPrefixTypeTransfer($type);
    }
}
