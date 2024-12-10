<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Parser;

interface ContentParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function parseContent(string $content): array;
}
