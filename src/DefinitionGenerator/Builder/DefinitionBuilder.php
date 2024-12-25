<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use ArrayObject;
use Generator;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

readonly class DefinitionBuilder implements DefinitionBuilderInterface
{
    use DefinitionBuilderTrait;

    /**
     * @param \ArrayObject<int,BuilderExpanderInterface> $builderExpanders
     */
    public function __construct(private ArrayObject $builderExpanders)
    {
    }

    public function buildDefinitionContents(DefinitionGeneratorContentTransfer $generatorContentTransfer): Generator
    {
        $builderTransfer = $this->getBuilderTransfer($generatorContentTransfer);
        yield $builderTransfer->definitionContent;

        foreach ($builderTransfer->generatorContents as $generatorContentTransfer) {
            yield from $this->buildDefinitionContents($generatorContentTransfer);
        }
    }

    private function getBuilderTransfer(
        DefinitionGeneratorContentTransfer $generatorContentTransfer
    ): DefinitionBuilderTransfer {
        $builderTransfer = $this->createDefinitionBuilderTransfer($generatorContentTransfer->className);
        foreach ($generatorContentTransfer->content as $propertyName => $propertyValue) {
            $builderContent = $this->createBuilderContent((string)$propertyName, $propertyValue);
            $this->handlerBuilderExpanders($builderContent, $builderTransfer);
        }

        return $builderTransfer;
    }

    private function handlerBuilderExpanders(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void {
        foreach ($this->builderExpanders as $builderExpander) {
            if (!$builderExpander->isApplicable($content)) {
                continue;
            }

            $builderExpander->expandBuilderTransfer($content, $builderTransfer);

            return;
        }
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
