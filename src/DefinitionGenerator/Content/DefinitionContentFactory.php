<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content;

use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilder;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuildInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\CollectionTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\TransferTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Content\Reader\ContentReader;
use Picamator\TransferObject\DefinitionGenerator\Content\Reader\ContentReaderInterface;
use Picamator\TransferObject\Shared\CachedFactoryTrait;

class DefinitionContentFactory
{
    use CachedFactoryTrait;

    public function createContentReader(): ContentReaderInterface
    {
        return $this->getCached(
            key: 'definition-generator:ContentReader',
            factory: fn (): ContentReaderInterface => new ContentReader(
                $this->createContentBuilder(),
                $this->createBuilderExpander(),
            ),
        );
    }

    protected function createContentBuilder(): ContentBuilderInterface
    {
        return new ContentBuilder();
    }

    protected function createBuilderExpander(): BuilderExpanderInterface
    {
        $builderExpander = $this->createTransferTypeBuilderExpander();

        $builderExpander
            ->setNextExpander($this->createCollectionTypeBuilderExpander())
            ->setNextExpander($this->createBuildInTypeBuilderExpander());

        return $builderExpander;
    }

    protected function createBuildInTypeBuilderExpander(): BuilderExpanderInterface
    {
        return new BuildInTypeBuilderExpander();
    }

    protected function createCollectionTypeBuilderExpander(): BuilderExpanderInterface
    {
        return new CollectionTypeBuilderExpander();
    }

    protected function createTransferTypeBuilderExpander(): BuilderExpanderInterface
    {
        return new TransferTypeBuilderExpander();
    }
}
