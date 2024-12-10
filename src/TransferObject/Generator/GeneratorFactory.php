<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Picamator\TransferObject\Generator\Filesystem\DefinitionFilesystem;
use Picamator\TransferObject\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Generator\Filesystem\GeneratedFilesystem;
use Picamator\TransferObject\Generator\Filesystem\GeneratedFilesystemInterface;
use Picamator\TransferObject\Generator\Parser\ContentParserInterface;
use Picamator\TransferObject\Generator\Parser\YmlContentParser;
use Picamator\TransferObject\Generator\Reader\DefinitionReader;
use Picamator\TransferObject\Generator\Reader\DefinitionReaderBuilder;
use Picamator\TransferObject\Generator\Reader\DefinitionReaderBuilderInterface;
use Picamator\TransferObject\Generator\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\Generator\Template\TemplateRender;
use Picamator\TransferObject\Generator\Template\TemplateRenderInterface;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generator\Validator\DefinitionValidator;
use Picamator\TransferObject\Generator\Validator\DefinitionValidatorInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

readonly class GeneratorFactory
{
    public function __construct(private ConfigTransfer $configTransfer)
    {
    }

    public function createGeneratorFiber(): GeneratorFiberInterface
    {
        return new GeneratorFiber(
            $this->createDefinitionReader(),
            $this->createTemplateRender(),
            $this->createGeneratedFilesystem(),
        );
    }

    private function createGeneratedFilesystem(): GeneratedFilesystemInterface
    {
        return new GeneratedFilesystem(
            $this->createFilesystem(),
            $this->createFinder(),
            $this->configTransfer,
        );
    }

    private function createFilesystem(): Filesystem
    {
        return new Filesystem();
    }

    private function createTemplateRender(): TemplateRenderInterface
    {
        return new TemplateRender();
    }

    private function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionReader(
            $this->createDefinitionFilesystem(),
            $this->createYmlContentParser(),
            $this->createDefinitionReaderBuilder(),
        );
    }

    private function createDefinitionReaderBuilder(): DefinitionReaderBuilderInterface
    {
        return new DefinitionReaderBuilder($this->createDefinitionValidator(), $this->configTransfer);
    }

    private function createDefinitionValidator(): DefinitionValidatorInterface
    {
        return new DefinitionValidator();
    }

    private function createDefinitionValidatorBuilder(): DefinitionValidatorBuilderInterface
    {
        return new DefinitionValidatorBuilder();
    }

    private function createYmlContentParser(): ContentParserInterface
    {
        return new YmlContentParser($this->createYmlParser());
    }

    private function createYmlParser(): Parser
    {
        return new Parser();
    }

    private function createDefinitionFilesystem(): DefinitionFilesystemInterface
    {
        return new DefinitionFilesystem(
            $this->createFinder(),
            $this->configTransfer,
        );
    }

    private function createFinder(): Finder
    {
        return new Finder();
    }
}
