<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Reader;

use Generator;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

readonly class ContentReader implements ContentReaderInterface
{
    public function __construct(
        private ContentBuilderInterface $contentBuilder,
        private BuilderExpanderInterface $builderExpander,
    ) {
    }

    public function getDefinitionContents(DefinitionGeneratorContentTransfer $generatorContentTransfer): Generator
    {
        $builderTransfer = $this->getBuilderTransfer($generatorContentTransfer);
        yield $builderTransfer->definitionContent;

        foreach ($builderTransfer->generatorContents as $contentTransfer) {
            yield from $this->getDefinitionContents($contentTransfer);
        }
    }

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    private function getBuilderTransfer(
        DefinitionGeneratorContentTransfer $generatorContentTransfer,
    ): DefinitionBuilderTransfer {
        $builderTransfer = $this->createDefinitionBuilderTransfer($generatorContentTransfer->className);

        foreach ($generatorContentTransfer->content as $propertyName => $propertyValue) {
            $builderContent = $this->contentBuilder->createBuilderContent((string)$propertyName, $propertyValue);
            $this->builderExpander->expandBuilderTransfer($builderContent, $builderTransfer);
        }

        return $builderTransfer;
    }

    private function createDefinitionBuilderTransfer(string $className): DefinitionBuilderTransfer
    {
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = $className;

        $builderTransfer = new DefinitionBuilderTransfer();
        $builderTransfer->definitionContent = $contentTransfer;

        return $builderTransfer;
    }
}
