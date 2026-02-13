<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Parser;

trait DocBlockParserTrait
{
    private const string DOCK_BLOCK_REGEX = '#^(?<type>[^<> ]+)\s*(?<docBlock><.+>)$#';

    final protected function parseTypeWithDocBlock(string $type): TypeDocBlock
    {
        if (!str_contains($type, '<') || preg_match(self::DOCK_BLOCK_REGEX, $type, $matches) !== 1) {
            return new TypeDocBlock(type: $type);
        }

        return new TypeDocBlock(
            type: $matches['type'],
            docBlock: $matches['docBlock'],
        );
    }
}
