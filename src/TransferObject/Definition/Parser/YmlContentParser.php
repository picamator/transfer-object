<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Parser;

use Picamator\TransferObject\Exception\GeneratorTransferException;
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
            throw new GeneratorTransferException(
                sprintf('Cannot parse content "%s".', $content),
                previous: $e,
            );
        }
    }
}
