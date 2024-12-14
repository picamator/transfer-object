<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Parser;

interface ContentParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\DefinitionTransferException
     *
     * @return array<string, array<string, array<string, string>>>
     */
    public function parseContent(string $content): array;
}
