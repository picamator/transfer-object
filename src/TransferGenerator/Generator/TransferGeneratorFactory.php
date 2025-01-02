<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator;

use ArrayObject;
use Fiber;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactory;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\DefinitionFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\BulkTransferGenerator;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\BulkTransferGeneratorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\FiberTransferGenerator;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\FiberTransferGeneratorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
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

readonly class TransferGeneratorFactory
{
    use ConfigFactoryTrait;
    use DependencyFactoryTrait;

    /**
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     */
    public function createTransferGeneratorFiber(): Fiber
    {
        return new Fiber($this->createFiberTransferGenerator()->getTransferFiberCallback(...));
    }

    private function createFiberTransferGenerator(): FiberTransferGeneratorInterface
    {
        return new FiberTransferGenerator($this->createTransferGenerator());
    }

    public function createTransferGenerator(): TransferGeneratorInterface
    {
        return new TransferGenerator(
            $this->createDefinitionReader(),
            $this->createGeneratorProcessor(),
        );
    }

    public function createBulkTransferGenerator(): BulkTransferGeneratorInterface
    {
        return new BulkTransferGenerator($this->createTransferGenerator());
    }

    protected function createGeneratorProcessor(): GeneratorProcessorInterface
    {
        return new GeneratorProcessor(
            $this->createConfigLoader(),
            $this->createTransferGeneratorBuilder(),
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

    protected function createTransferGeneratorBuilder(): TransferGeneratorBuilderInterface
    {
        return new TransferGeneratorBuilder();
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

    protected function createConfigLoader(): ConfigLoaderInterface
    {
        return new ConfigFactory()->createConfigLoader();
    }

    protected function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionFactory()->createDefinitionReader();
    }
}
