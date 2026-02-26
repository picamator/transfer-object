<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactory;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\DefinitionFactory;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\HashFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\HashFilesystemInterface;
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
use Picamator\TransferObject\TransferGenerator\Generator\Reader\TransferHashReader;
use Picamator\TransferObject\TransferGenerator\Generator\Reader\TransferHashReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\RenderFactory;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferRotator;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferRotatorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferWriter;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferWriterInterface;

class GeneratorFactory
{
    use SharedFactoryTrait;
    use ConfigFactoryTrait;

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
            $this->createTransferRotator(),
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
            $this->createTransferWriter(),
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
        /** @var GeneratorFilesystemInterface $generatorFilesystem */
        $generatorFilesystem = $this->getLazyGhost(
            className: GeneratorFilesystem::class,
            initializer: function (GeneratorFilesystem $ghost): void {
                $ghost->__construct(
                    $this->createFilesystem(),
                    $this->getConfig(),
                );
            }
        );

        return $generatorFilesystem;
    }

    protected function createTransferRotator(): TransferRotatorInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferRotator',
            factory: fn(): TransferRotatorInterface => new TransferRotator(
                $this->createTransferHashReader(),
                $this->createHashFilesystem(),
                $this->createGeneratorFilesystem(),
            ),
        );
    }

    protected function createTransferGeneratorBuilder(): TransferGeneratorBuilderInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferGeneratorBuilder',
            factory: fn() => new TransferGeneratorBuilder(),
        );
    }

    protected function createHashFilesystem(): HashFilesystemInterface
    {
        return $this->getCached(
            key: 'transfer-generator:HashFilesystem',
            factory: fn() => new HashFilesystem(
                $this->createFilesystem(),
                $this->createHashFileWriter(),
                $this->getConfig(),
            ),
        );
    }

    protected function createTransferWriter(): TransferWriterInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferWriter',
            factory: fn(): TransferWriterInterface => new TransferWriter(
                $this->createTransferHashReader(),
                $this->createGeneratorFilesystem(),
            ),
        );
    }

    protected function createTransferHashReader(): TransferHashReaderInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TransferHashReader',
            factory: fn(): TransferHashReaderInterface => new TransferHashReader(
                $this->createHashFileReader(),
                $this->getConfig(),
            ),
        );
    }

    protected function createTemplateRender(): TemplateRenderInterface
    {
        return $this->getCached(
            key: 'transfer-generator:TemplateRender',
            factory: fn(): TemplateRenderInterface => new RenderFactory()->createTemplateRender(),
        );
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
