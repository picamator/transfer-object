<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator;

use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactory;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\DefinitionFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBulkBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBulkBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGenerator;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorBulkFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorBulkFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiber;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorFiberInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorService;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorServiceInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\BuildInTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\CollectionTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\DateTimeTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\EnumTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\MetaConstantsTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\NamespaceTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\NumberTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\ProtectedTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TransferTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Template;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelper;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelperInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class TransferGeneratorFactory
{
    use ConfigFactoryTrait;
    use SharedFactoryTrait;

    private TransferGeneratorInterface $transferGenerator;

    private TransferGeneratorServiceInterface $transferGeneratorService;

    public function createTransferGeneratorFiber(): TransferGeneratorFiberInterface
    {
        return new TransferGeneratorFiber($this->createTransferGenerator());
    }

    public function createTransferGenerator(): TransferGeneratorInterface
    {
        return $this->transferGenerator ??= new TransferGenerator(
            $this->createDefinitionReader(),
            $this->createTransferGeneratorBuilder(),
            $this->createGeneratorProcessor(),
        );
    }

    public function createTransferGeneratorService(): TransferGeneratorServiceInterface
    {
        return $this->transferGeneratorService ??= new TransferGeneratorService($this->createTransferGenerator());
    }

    public function createTransferGeneratorBulkFiber(): TransferGeneratorBulkFiberInterface
    {
        return new TransferGeneratorBulkFiber(
            $this->createFileReaderProgress(),
            $this->createTransferGeneratorBulkBuilder(),
            $this->createTransferGeneratorService(),
        );
    }

    protected function createTransferGeneratorBulkBuilder(): TransferGeneratorBulkBuilderInterface
    {
        return new TransferGeneratorBulkBuilder();
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
            $this->getFilesystem(),
            $this->getFinder(),
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
            $this->createTemplate(),
        );
    }

    protected function createTemplate(): Template
    {
        return new Template($this->createTemplateHelper());
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
            ->setNextExpander($this->createMetaConstantsTemplateExpander())
            ->setNextExpander($this->createProtectedTemplateExpander())
            ->setNextExpander($this->createDateTimeTypeTemplateExpander())
            ->setNextExpander($this->createNumberTypeTemplateExpander());

        return $templateExpander;
    }

    protected function createNumberTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new NumberTypeTemplateExpander();
    }

    protected function createDateTimeTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new DateTimeTypeTemplateExpander();
    }

    protected function createProtectedTemplateExpander(): TemplateExpanderInterface
    {
        return new ProtectedTemplateExpander();
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
