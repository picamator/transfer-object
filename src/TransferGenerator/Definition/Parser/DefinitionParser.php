<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser;

use Generator;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\ContentBuilderInterface;

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

            /** @var array<string, mixed> $properties */
            $properties = is_array($properties) ? $properties : [];
            $properties = array_map($this->filterProperties(...), $properties);

            yield $this->contentBuilder->createContentTransfer(
                className: (string)$className,
                properties: $properties,
            );
        }

        return $count;
    }

    /**
     * @param mixed $propertyType
     * @return array<string,string|null>
     */
    private function filterProperties(mixed $propertyType): array
    {
        if (!is_array($propertyType)) {
            return [];
        }

        $filteredType = [];
        foreach ($propertyType as $key => $typeItem) {
            if (!is_string($key)) {
                continue;
            }

            if (is_bool($typeItem)) {
                $filteredType[$key] = BuildInTypeEnum::getTrueFalse($typeItem)->value;

                continue;
            }

            if (is_string($typeItem) || is_null($typeItem)) {
                $filteredType[$key] = $typeItem;
            }
        }

        return $filteredType;
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
