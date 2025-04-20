<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator;

use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactory;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\DefinitionFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorService;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorServiceInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGenerator;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\BuildInTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\CollectionTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\EnumTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\MetaConstantsTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\NamespaceTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TransferTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateHelper;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateHelperInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

readonly class TransferGeneratorFactory
{
    use ConfigFactoryTrait;
    use DependencyFactoryTrait;

    public function createTransferGeneratorFiber(): TransferGeneratorFiberInterface
    {
        return new TransferGeneratorFiber($this->createTransferGenerator());
    }

    public function createTransferGenerator(): TransferGeneratorInterface
    {
        return new TransferGenerator(
            $this->createDefinitionReader(),
            $this->createGeneratorProcessor(),
        );
    }

    public function createTransferGeneratorService(): TransferGeneratorServiceInterface
    {
        return new TransferGeneratorService($this->createTransferGenerator());
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

    protected function createTransferGeneratorBuilder(): TransferGeneratorBuilderInterface
    {
        return new TransferGeneratorBuilder();
    }

    protected function createTemplateRender(): TemplateRenderInterface
    {
        return new TemplateRender(
            $this->createTemplateBuilder(),
            $this->createTemplateHelper(),
        );
    }

    protected function createTemplateHelper(): TemplateHelperInterface
    {
        return new TemplateHelper();
    }

    protected function createTemplateBuilder(): TemplateBuilderInterface
    {
        return new TemplateBuilder(
            $this->getConfig(),
            $this->createTemplateExpander(),
        );
    }

    protected function createTemplateExpander(): TemplateExpanderInterface
    {
        $templateExpander = $this->createCollectionTypeTemplateExpander();

        $templateExpander
            ->setNextExpander($this->createTransferTypeTemplateExpander())
            ->setNextExpander($this->createBuildInTypeTemplateExpander())
            ->setNextExpander($this->createEnumTypeTemplateExpander())
            ->setNextExpander($this->createNamespaceTemplateExpander())
            ->setNextExpander($this->createMetaConstantsTemplateExpander());

        return $templateExpander;
    }

    protected function createMetaConstantsTemplateExpander(): TemplateExpanderInterface
    {
        return new MetaConstantsTemplateExpander();
    }

    protected function createNamespaceTemplateExpander(): TemplateExpanderInterface
    {
        return new NamespaceTemplateExpander();
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

    protected function createConfigLoader(): ConfigLoaderInterface
    {
        return new ConfigFactory()->createConfigLoader();
    }

    protected function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionFactory()->createDefinitionReader();
    }
}
