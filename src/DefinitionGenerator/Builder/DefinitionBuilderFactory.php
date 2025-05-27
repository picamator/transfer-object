<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuildInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\CollectionTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\TransferTypeBuilderExpander;
use Picamator\TransferObject\Shared\CachedFactoryTrait;

class DefinitionBuilderFactory
{
    use CachedFactoryTrait;

    public function createDefinitionBuilder(): DefinitionBuilderInterface
    {
        return $this->getCached(
            key: 'definition-builder',
            factory: fn (): DefinitionBuilderInterface => new DefinitionBuilder(
                $this->createDefinitionContentBuilder(),
                $this->createBuilderExpander(),
            ),
        );
    }

    protected function createDefinitionContentBuilder(): DefinitionContentBuilderInterface
    {
        return new DefinitionContentBuilder();
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
