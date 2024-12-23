<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator;

use ArrayObject;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilder;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuildInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\CollectionTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\TransferTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystem;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\DefinitionGenerator;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\DefinitionGeneratorInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRender;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Symfony\Component\Filesystem\Filesystem;

readonly class DefinitionGeneratorFactory
{
    use DependencyFactoryTrait;

    public function createDefinitionGenerator(): DefinitionGeneratorInterface
    {
        return new DefinitionGenerator(
            $this->createDefinitionBuilder(),
            $this->createDefinitionRender(),
            $this->createDefinitionFilesystem(),
        );
    }

    protected function createDefinitionFilesystem(): DefinitionFilesystemInterface
    {
        return new DefinitionFilesystem($this->createFilesystem());
    }

    protected function createFilesystem(): Filesystem
    {
        return $this->getDependency(DependencyContainer::FILESYSTEM);
    }

    protected function createDefinitionRender(): DefinitionRenderInterface
    {
        return new DefinitionRender();
    }

    protected function createDefinitionBuilder(): DefinitionBuilderInterface
    {
        return new DefinitionBuilder($this->createBuilderExpanders());
    }

    /**
     * @return ArrayObject<int,\Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface>
     */
    protected function createBuilderExpanders(): ArrayObject
    {
        return new ArrayObject([
            $this->createTransferTypeBuilderExpander(),
            $this->createCollectionTypeBuilderExpander(),
            $this->createBuildInTypeBuilderExpander(),
        ]);
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
