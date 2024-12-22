<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

interface FileParserInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\ConfigTransferException
     *
     * @return array<string,array<string,string>>
     */
    public function parseFile(string $filePath): array;
}
