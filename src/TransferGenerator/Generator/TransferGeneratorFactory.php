<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator;

use ArrayObject;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Definition\DefinitionFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGenerator;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\BuildInTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\CollectionTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\EnumTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TransferTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;
use Symfony\Component\Finder\Finder;

readonly class TransferGeneratorFactory
{
    use ConfigFactoryTrait;
    use DependencyFactoryTrait;

    public function createTransferGenerator(): TransferGeneratorInterface
    {
        return new TransferGenerator(
            $this->createDefinitionReader(),
            $this->createTemplateRender(),
            $this->createGeneratorFilesystem(),
        );
    }

    protected function createGeneratorFilesystem(): GeneratorFilesystemInterface
    {
        return new GeneratorFilesystem(
            $this->createFilesystem(),
            $this->createFinder(),
            $this->getConfig(),
        );
    }

    protected function createFilesystem(): FilesystemInterface
    {
        return $this->getDependency(DependencyContainer::FILESYSTEM);
    }

    protected function createTemplateRender(): TemplateRenderInterface
    {
        return new TemplateRender(
            $this->createTemplateBuilder(),
        );
    }

    protected function createTemplateBuilder(): TemplateBuilderInterface
    {
        return new TemplateBuilder(
            $this->getConfig(),
            $this->createTemplateExpanders(),
        );
    }

    /**
     * @return ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface>
     */
    protected function createTemplateExpanders(): ArrayObject
    {
        return new ArrayObject([
            $this->createCollectionTypeTemplateExpander(),
            $this->createTransferTypeTemplateExpander(),
            $this->createBuildInTypeTemplateExpander(),
            $this->createEnumTypeTemplateExpander(),
        ]);
    }

    protected function createEnumTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new EnumTypeTemplateExpander();
    }

    protected function createBuildInTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new BuildInTypeTemplateExpander();
    }

    protected function createTransferTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new TransferTypeTemplateExpander();
    }

    protected function createCollectionTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new CollectionTypeTemplateExpander();
    }

    protected function createFinder(): FinderInterface
    {
        return $this->getDependency(DependencyContainer::FINDER);
    }

    protected function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionFactory()->createDefinitionReader();
    }
}
