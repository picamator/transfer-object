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
                sprintf('Fail parse file "%s", error "%s".', $filename, $e->getMessage()),
                previous: $e,
            );
        }
    }

    public function parse(string $value): mixed
    {
        try {
            return $this->ymlParser->parse($value);
        } catch (Throwable $e) {
            throw new YmlParserException(
                sprintf('Fail parse string "%s", error "%s".', $value, $e->getMessage()),
                previous: $e,
            );
        }
    }
}
