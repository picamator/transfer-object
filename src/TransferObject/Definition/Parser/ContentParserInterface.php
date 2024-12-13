<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Parser;

interface ContentParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\DefinitionTransferException
     */
    public function parseContent(string $content): array;
}
