<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;
use Symfony\Component\Yaml\Parser;
use Throwable;

readonly class YmlContentParser implements ContentParserInterface
{
    public function __construct(private Parser $yml)
    {
    }

    public function parseContent(string $content): array
    {
        try {
            return $this->yml->parse($content);
        } catch (Throwable $e) {
            throw new TransferGeneratorDefinitionException(
                sprintf('Cannot parse content "%s".', $content),
                previous: $e,
            );
        }
    }
}
