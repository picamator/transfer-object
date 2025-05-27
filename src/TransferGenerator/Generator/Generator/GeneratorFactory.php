<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Shared\CachedFactoryTrait;
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
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\BulkProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\BulkProcessCommandInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommandInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PreProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PreProcessCommandInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\ProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\ProcessCommandInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\RenderFactory;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class GeneratorFactory
{
    use SharedFactoryTrait;
    use ConfigFactoryTrait;
    use CachedFactoryTrait;

    public function createGeneratorProcessor(): GeneratorProcessorInterface
    {
        return new GeneratorProcessor(
            $this->createPreProcessCommand(),
            $this->createBulkProcessCommand(),
            $this->createPostProcessCommand(),
        );
    }

    protected function createPostProcessCommand(): PostProcessCommandInterface
    {
        return new PostProcessCommand(
            $this->createTransferGeneratorBuilder(),
            $this->createGeneratorFilesystem(),
        );
    }

    protected function createBulkProcessCommand(): BulkProcessCommandInterface
    {
        return new BulkProcessCommand(
            $this->createDefinitionReader(),
            $this->createProcessCommand(),
        );
    }

    protected function createProcessCommand(): ProcessCommandInterface
    {
        return new ProcessCommand(
            $this->createTransferGeneratorBuilder(),
            $this->createTemplateRender(),
            $this->createGeneratorFilesystem(),
        );
    }

    protected function createPreProcessCommand(): PreProcessCommandInterface
    {
        return new PreProcessCommand(
            $this->createConfigLoader(),
            $this->createTransferGeneratorBuilder(),
            $this->createGeneratorFilesystem(),
        );
    }

    protected function createGeneratorFilesystem(): GeneratorFilesystemInterface
    {
        return $this->getCached(
            key: 'generator-filesystem',
            factory: fn () => new GeneratorFilesystem(
                $this->getFilesystem(),
                $this->getFinder(),
                $this->getConfig(),
            ),
        );
    }

    protected function createTransferGeneratorBuilder(): TransferGeneratorBuilderInterface
    {
        return $this->getCached(
            key: 'generator-builder',
            factory: fn () => new TransferGeneratorBuilder(),
        );
    }

    protected function createTemplateRender(): TemplateRenderInterface
    {
        return new RenderFactory()->createTemplateRender();
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
