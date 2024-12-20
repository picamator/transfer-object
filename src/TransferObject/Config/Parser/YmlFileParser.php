<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Parser;

use Picamator\TransferObject\Exception\ConfigTransferException;
use Symfony\Component\Yaml\Parser;
use Throwable;

readonly class YmlFileParser implements FileParserInterface
{
    public function __construct(
        private Parser $yml,
    ) {
    }

    public function parseFile(string $filePath): array
    {
        try {
            return $this->yml->parseFile($filePath);
        } catch (Throwable $e) {
            throw new ConfigTransferException(
                sprintf(
                    'Cannot parse file "%s".',
                    $filePath,
                ),
                previous: $e,
            );
        }
    }
}
