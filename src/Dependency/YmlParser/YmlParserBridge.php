<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\YmlParser;

use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Symfony\Component\Yaml\Parser;
use Throwable;

final readonly class YmlParserBridge implements YmlParserInterface
{
    public function __construct(private Parser $ymlParser)
    {
    }

    public function parseFile(string $filename): mixed
    {
        try {
            return $this->ymlParser->parseFile($filename);
        } catch (Throwable $e) {
            throw new YmlParserException(
                sprintf('Failed to parse file "%s". Error: "%s".', $filename, $e->getMessage()),
                previous: $e,
            );
        }
    }
}
