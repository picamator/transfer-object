<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilder;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionContentBuilder;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuildInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\CollectionTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\TransferTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilder;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystem;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\DefinitionGeneratorService;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\DefinitionGeneratorServiceInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRender;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Shared\SharedFactoryTrait;

class DefinitionGeneratorFactory
{
    use SharedFactoryTrait;

    private DefinitionGeneratorServiceInterface $definitionGeneratorService;

    private DefinitionGeneratorBuilderInterface $definitionGeneratorBuilder;

    public function createDefinitionGeneratorService(): DefinitionGeneratorServiceInterface
    {
        return $this->definitionGeneratorService ??= new DefinitionGeneratorService(
            $this->createDefinitionBuilder(),
            $this->createDefinitionRender(),
            $this->createDefinitionFilesystem(),
        );
    }

    public function createDefinitionGeneratorBuilder(): DefinitionGeneratorBuilderInterface
    {
        return $this->definitionGeneratorBuilder ??= new DefinitionGeneratorBuilder(
            $this->createPathValidator(),
            $this->createClassNameValidator(),
            $this->createJsonReader(),
        );
    }

    protected function createDefinitionFilesystem(): DefinitionFilesystemInterface
    {
        return new DefinitionFilesystem(
            $this->getFilesystem(),
            $this->createFileAppender(),
        );
    }

    protected function createDefinitionRender(): DefinitionRenderInterface
    {
        return new DefinitionRender();
    }

    protected function createDefinitionBuilder(): DefinitionBuilderInterface
    {
        return new DefinitionBuilder(
            $this->createDefinitionContentBuilder(),
            $this->createBuilderExpander(),
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
