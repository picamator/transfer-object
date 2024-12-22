<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

interface ContentParserInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\DefinitionTransferException
     *
     * @return array<string, array<string, array<string, string>>>
     */
    public function parseContent(string $content): array;
}
