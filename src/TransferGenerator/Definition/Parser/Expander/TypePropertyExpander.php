<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionBuiltInTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Shared\Parser\DocBlockParserTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuiltInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\EmbeddedTypeBuilderInterface;

final class TypePropertyExpander extends AbstractPropertyExpander
{
    use DocBlockParserTrait;

    private const string TYPE_KEY = 'type';

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

    /**
     * @param string $matchedType
     */
    protected function handleExpander(mixed $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $builtInTypeTransfer = $this->getBuiltInTypeTransfer($matchedType);
        if ($builtInTypeTransfer !== null) {
            $propertyTransfer->builtInType = $builtInTypeTransfer;

            return;
        }

        $propertyTransfer->transferType = $this->typeBuilder->createPrefixTypeTransfer($matchedType);
    }

    private function getBuiltInTypeTransfer(string $matchedType): ?DefinitionBuiltInTypeTransfer
    {
        $typeDocBlock = $this->parseTypeWithDocBlock($matchedType);
        $type = BuiltInTypeEnum::tryFrom($typeDocBlock->type);

        if ($type === null) {
            return null;
        }

        $builtInTypeTransfer = new DefinitionBuiltInTypeTransfer();
        $builtInTypeTransfer->name = $type;
        $builtInTypeTransfer->docBlock = $typeDocBlock->docBlock;

        return $builtInTypeTransfer;
    }
}
