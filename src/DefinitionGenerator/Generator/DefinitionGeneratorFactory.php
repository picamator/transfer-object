<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilder;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
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
        return new DefinitionBuilder();
    }
}
