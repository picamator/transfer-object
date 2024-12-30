<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\YmlParser;

interface YmlParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     */
    public function parseFile(string $filename): mixed;
}
