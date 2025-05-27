<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator;

// phpcs:disable Generic.Files.LineLength
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderFactory;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilder;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystem;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\DefinitionGeneratorService;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\DefinitionGeneratorServiceInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\DefinitionProcessCommand;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\DefinitionProcessCommandInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\PostDefinitionProcessCommand;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\PostDefinitionProcessCommandInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\PreDefinitionProcessCommand;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\PreDefinitionProcessCommandInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\DefinitionGeneratorProcessor;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\DefinitionGeneratorProcessorInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRender;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\Shared\SharedFactoryTrait;

class DefinitionGeneratorFactory
{
    use SharedFactoryTrait;
    use CachedFactoryTrait;

    private static DefinitionBuilderFactory $definitionBuilderFactory;

    public function createDefinitionGeneratorService(): DefinitionGeneratorServiceInterface
    {
        return $this->getCached(
            key: 'definition-generator-service',
            factory: fn (): DefinitionGeneratorServiceInterface => new DefinitionGeneratorService(
                $this->createDefinitionGeneratorProcessor(),
            ),
        );
    }

    public function createDefinitionGeneratorBuilder(): DefinitionGeneratorBuilderInterface
    {
        return $this->getCached(
            key: 'definition-generator-builder',
            factory: fn (): DefinitionGeneratorBuilderInterface => new DefinitionGeneratorBuilder(
                $this->createPathLocalValidator(),
                $this->createClassNameValidator(),
                $this->createJsonReader(),
            ),
        );
    }

    protected function createDefinitionGeneratorProcessor(): DefinitionGeneratorProcessorInterface
    {
        return new DefinitionGeneratorProcessor(
            $this->createPreDefinitionProcessCommand(),
            $this->createDefinitionProcessCommand(),
            $this->createPostDefinitionProcessCommand(),
        );
    }

    protected function createPostDefinitionProcessCommand(): PostDefinitionProcessCommandInterface
    {
        return new PostDefinitionProcessCommand(
            $this->createDefinitionFilesystem(),
        );
    }

    protected function createDefinitionProcessCommand(): DefinitionProcessCommandInterface
    {
        return new DefinitionProcessCommand(
            $this->createDefinitionBuilder(),
            $this->createDefinitionRender(),
            $this->createDefinitionFilesystem(),
        );
    }

    protected function createPreDefinitionProcessCommand(): PreDefinitionProcessCommandInterface
    {
        return new PreDefinitionProcessCommand(
            $this->createDefinitionRender(),
            $this->createDefinitionFilesystem(),
        );
    }

    protected function createDefinitionFilesystem(): DefinitionFilesystemInterface
    {
        return $this->getCached(
            key: 'definition-filesystem',
            factory: fn (): DefinitionFilesystemInterface => new DefinitionFilesystem(
                $this->getFilesystem(),
                $this->createFileAppender(),
            ),
        );
    }

    protected function createDefinitionRender(): DefinitionRenderInterface
    {
        return $this->getCached(
            key: 'definition-render',
            factory: fn (): DefinitionRenderInterface => new DefinitionRender()
        );
    }

    protected function createDefinitionBuilder(): DefinitionBuilderInterface
    {
        return $this->getDefinitionBuilderFactory()
            ->createDefinitionBuilder();
    }

    protected function getDefinitionBuilderFactory(): DefinitionBuilderFactory
    {
        return self::$definitionBuilderFactory ??= new DefinitionBuilderFactory();
    }
}
