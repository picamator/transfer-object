<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Parser;

trait DocBlockParserTrait
{
    private const string TYPE_KEY = 'type';

    private const string DOC_BLOCK_KEY = 'docBlock';

    private const string TYPE_REGEX = '#(?<type>[^<>]*)(?<docBlock>.*)#';

    /**
     * @return array<string,string>|null
     */
    final protected function parseTypeWithDocBlock(string $type): ?array
    {
        if (preg_match(self::TYPE_REGEX, $type, $matches) !== 1) {
            return null;
        }

        $type = $matches[self::TYPE_KEY];
        $docBlock = $matches[self::DOC_BLOCK_KEY];

        return [$type => $docBlock];
    }
}
