<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Reader;

use Generator;
use Picamator\TransferObject\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Generator\Parser\ContentParserInterface;

readonly class DefinitionReader implements DefinitionReaderInterface
{
    public function __construct(
        private DefinitionFilesystemInterface $filesystem,
        private ContentParserInterface $parser,
        private DefinitionReaderBuilderInterface $readerBuilder,
    ) {
    }

    public function getDefinitions(): Generator
    {
        $definitionContents = $this->filesystem->getDefinitionContent();
        foreach ($definitionContents as $fileName => $definitionContent) {
            $definition = $this->parser->parseContent($definitionContent);

            foreach ($definition as $className => $properties) {
                $definitionKey = $fileName . ':' . $className;
                $definitionTransfer = $this->readerBuilder->createDefinitionTransfer([$className => $properties]);

                yield $definitionKey => $definitionTransfer;
            }
        }
    }

    public function countDefinitions(): int
    {
        return $this->filesystem->countDefinitions();
    }
}
