<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Picamator\TransferObject\Config\ConfigFactoryTrait;
use Picamator\TransferObject\Definition\DefinitionFacade;
use Picamator\TransferObject\Definition\DefinitionFacadeInterface;
use Picamator\TransferObject\Generator\Fiber\GeneratorFiber;
use Picamator\TransferObject\Generator\Fiber\GeneratorFiberInterface;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\Generator\Render\TemplateRender;
use Picamator\TransferObject\Generator\Render\TemplateRenderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

readonly class GeneratorFactory
{
    use ConfigFactoryTrait;

    public function createGeneratorFiber(): GeneratorFiberInterface
    {
        return new GeneratorFiber(
            $this->createDefinitionFacade(),
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

    protected function createFilesystem(): Filesystem
    {
        return new Filesystem();
    }

    protected function createTemplateRender(): TemplateRenderInterface
    {
        return new TemplateRender(
            $this->getConfig(),
        );
    }

    protected function createFinder(): Finder
    {
        return new Finder();
    }

    protected function createDefinitionFacade(): DefinitionFacadeInterface
    {
        return new DefinitionFacade();
    }
}
