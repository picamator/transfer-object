<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Generator;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;

readonly class DefinitionParser implements DefinitionParserInterface
{
    public function __construct(
        private YmlParserInterface $parser,
        private ContentBuilderInterface $contentBuilder,
    ) {
    }

    public function parseDefinition(string $filePath): Generator
    {
        $count = 0;
        foreach ($this->parseFile($filePath) as $className => $properties) {
            $count++;
            $properties = is_array($properties) ? $properties : [];

            yield $this->contentBuilder->createContentTransfer(
                className: (string)$className,
                properties: $properties,
            );
        }

        return $count;
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return array<string|int,mixed>
     */
    private function parseFile(string $filePath): array
    {
        $definition = $this->parser->parseFile($filePath);

        return is_array($definition) ? $definition : [];
    }
}
