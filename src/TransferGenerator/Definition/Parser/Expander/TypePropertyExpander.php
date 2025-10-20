<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class TypePropertyExpander extends AbstractPropertyExpander
{
    private const string TYPE_KEY = 'type';

    private const string BUILD_IN_TYPE_REGEX = '#(?<type>[^<>]*)(?<dockBlock>.*)#';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function matchType(array $propertyType): ?string
    {
        /** @var string|null $matchType */
        $matchType = $propertyType[self::TYPE_KEY] ?? null;

        return $matchType;
    }

    protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $buildInTypeTransfer = $this->getBuildInTypeTransfer($matchedType);
        if ($buildInTypeTransfer !== null) {
            $propertyTransfer->buildInType = $buildInTypeTransfer;

            return;
        }

        $propertyTransfer->transferType = $this->typeBuilder->createPrefixTypeTransfer($matchedType);
    }

    private function getBuildInTypeTransfer(string $matchedType): ?DefinitionBuildInTypeTransfer
    {
        if (preg_match(self::BUILD_IN_TYPE_REGEX, $matchedType, $matches) === false) {
            return null;
        }

        $type = $matches['type'] ?? '';
        $type = BuildInTypeEnum::tryFrom($type);

        if ($type === null) {
            return null;
        }

        $buildInTypeTransfer = new DefinitionBuildInTypeTransfer();
        $buildInTypeTransfer->name = $type;
        $buildInTypeTransfer->dockBlock = $matches['dockBlock'] ?? null;

        return $buildInTypeTransfer;
    }
}
