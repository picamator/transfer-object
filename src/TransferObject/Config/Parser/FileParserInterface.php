<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Parser;

interface FileParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\ConfigTransferException
     *
     * @return array<string,array<string,string>>
     */
    public function parseFile(string $filePath): array;
}
