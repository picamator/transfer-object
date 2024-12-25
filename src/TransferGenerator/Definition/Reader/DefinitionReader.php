<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader;

use Generator;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    public function __construct(
        private DefinitionFinderInterface $finder,
        private YmlParserInterface $parser,
        private DefinitionBuilderInterface $definitionBuilder,
    ) {
    }

    public function getDefinitions(): Generator
    {
        $count = 0;
        foreach ($this->finder->getDefinitionContent() as $fileName => $definitionContent) {
            $definition = $this->parser->parse($definitionContent);

            foreach ($definition as $className => $properties) {
                $count++;
                yield $fileName . ':' . $className
                    => $this->definitionBuilder->buildDefinitionTransfer((string)$className, $properties);
            }
        }

        return $count;
    }
}
