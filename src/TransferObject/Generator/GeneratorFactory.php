<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use ArrayObject;
use Picamator\TransferObject\Config\ConfigFactoryTrait;
use Picamator\TransferObject\Definition\DefinitionFacade;
use Picamator\TransferObject\Definition\DefinitionFacadeInterface;
use Picamator\TransferObject\Generator\Generator\TransferGenerator;
use Picamator\TransferObject\Generator\Generator\TransferGeneratorInterface;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\Generator\Render\Expander\BuildInTypeTemplateExpander;
use Picamator\TransferObject\Generator\Render\Expander\CollectionTypeTemplateExpander;
use Picamator\TransferObject\Generator\Render\Expander\TemplateExpanderInterface;
use Picamator\TransferObject\Generator\Render\Expander\TransferTypeTemplateExpander;
use Picamator\TransferObject\Generator\Render\TemplateBuilder;
use Picamator\TransferObject\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\Generator\Render\TemplateRender;
use Picamator\TransferObject\Generator\Render\TemplateRenderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

readonly class GeneratorFactory
{
    use ConfigFactoryTrait;

    public function createTransferGenerator(): TransferGeneratorInterface
    {
        return new TransferGenerator(
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
     * @return ArrayObject<\Picamator\TransferObject\Generator\Render\Expander\TemplateExpanderInterface>
     */
    protected function createTemplateExpanders(): ArrayObject
    {
        return new ArrayObject([
            $this->createCollectionTypeTemplateExpander(),
            $this->createTransferTypeTemplateExpander(),
            $this->createBuildInTypeTemplateExpander(),
        ]);
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

    protected function createFinder(): Finder
    {
        return new Finder();
    }

    protected function createDefinitionFacade(): DefinitionFacadeInterface
    {
        return new DefinitionFacade();
    }
}
