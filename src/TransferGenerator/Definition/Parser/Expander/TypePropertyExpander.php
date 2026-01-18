<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Shared\Parser\DocBlockParserTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class TypePropertyExpander extends AbstractPropertyExpander
{
    use DocBlockParserTrait;

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
        $tapeWithDocBlock = $this->parseTypeWithDocBlock($matchedType);
        if ($tapeWithDocBlock === null) {
            return null;
        }

        /** @var string $type */
        $type = array_key_first($tapeWithDocBlock);
        $type = BuildInTypeEnum::tryFrom($type);

        if ($type === null) {
            return null;
        }

        $buildInTypeTransfer = new DefinitionBuildInTypeTransfer();
        $buildInTypeTransfer->name = $type;
        $buildInTypeTransfer->docBlock = array_first($tapeWithDocBlock);

        return $buildInTypeTransfer;
    }
}
