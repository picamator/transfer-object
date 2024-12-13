<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Fiber;
use Picamator\TransferObject\Definition\DefinitionFactory;
use Picamator\TransferObject\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generator\Expander\CollectionTypeTemplateExpander;
use Picamator\TransferObject\Generator\Expander\DefaultTemplateExpander;
use Picamator\TransferObject\Generator\Expander\TemplateExpanderInterface;
use Picamator\TransferObject\Generator\Expander\TypeTemplateExpander;
use Picamator\TransferObject\Generator\Fiber\GeneratorFiberCallback;
use Picamator\TransferObject\Generator\Fiber\GeneratorFiberCallbackInterface;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\Generator\Render\TemplateRender;
use Picamator\TransferObject\Generator\Render\TemplateRenderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

readonly class GeneratorFactory
{
    public function __construct(
        private ConfigTransfer $configTransfer,
    ) {
    }

    public function getGeneratorFiber(): Fiber
    {
        return new Fiber($this->createFiberCallback()->getFiberCallback(...));
    }

    protected function createFiberCallback(): GeneratorFiberCallbackInterface
    {
        return new GeneratorFiberCallback(
            $this->createDefinitionReader(),
            $this->createTemplateRender(),
            $this->createGeneratorFilesystem(),
        );
    }

    protected function createGeneratorFilesystem(): GeneratorFilesystemInterface
    {
        return new GeneratorFilesystem(
            $this->createFilesystem(),
            $this->createFinder(),
            $this->configTransfer,
        );
    }

    protected function createFilesystem(): Filesystem
    {
        return new Filesystem();
    }

    protected function createTemplateRender(): TemplateRenderInterface
    {
        return new TemplateRender(
            $this->configTransfer,
            $this->createTemplateExpander(),
        );
    }

    protected function createTemplateExpander(): TemplateExpanderInterface
    {
        $templateExpander = new CollectionTypeTemplateExpander();
        $templateExpander
            ->setNext(new TypeTemplateExpander())
            ->setNext(new DefaultTemplateExpander());

        return $templateExpander;
    }


    protected function createFinder(): Finder
    {
        return new Finder();
    }

    protected function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionFactory($this->configTransfer)->createDefinitionReader();
    }
}
