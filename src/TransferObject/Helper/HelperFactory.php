<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Helper\Generator\DefinitionGenerator;
use Picamator\TransferObject\Helper\Generator\DefinitionGeneratorInterface;
use Picamator\TransferObject\Helper\Filesystem\DefinitionFilesystem;
use Picamator\TransferObject\Helper\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Helper\Builder\DefinitionBuilder;
use Picamator\TransferObject\Helper\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\Helper\Render\DefinitionRender;
use Picamator\TransferObject\Helper\Render\DefinitionRenderInterface;
use Symfony\Component\Filesystem\Filesystem;

readonly class HelperFactory
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
