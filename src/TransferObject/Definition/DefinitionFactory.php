<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition;

use Picamator\TransferObject\Config\ConfigFactoryTrait;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFilesystem;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Definition\Parser\ContentParserInterface;
use Picamator\TransferObject\Definition\Parser\YmlContentParser;
use Picamator\TransferObject\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\Definition\Validator\ClassNameValidator;
use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Definition\Validator\ContentValidator;
use Picamator\TransferObject\Definition\Validator\ContentValidatorInterface;
use Picamator\TransferObject\Definition\Validator\PropertyValidator;
use Picamator\TransferObject\Definition\Validator\PropertyValidatorInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

readonly class DefinitionFactory
{
    use ConfigFactoryTrait;

    public function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionReader(
            $this->createFilesystem(),
            $this->createContentParser(),
            $this->createContentValidator(),
        );
    }

    protected function createContentValidator(): ContentValidatorInterface
    {
        return new ContentValidator(
            $this->createClassNameValidator(),
            $this->createPropertyValidator(),
        );
    }

    protected function createPropertyValidator(): PropertyValidatorInterface
    {
        return new PropertyValidator($this->createClassNameValidator());
    }

    protected function createClassNameValidator(): ClassNameValidatorInterface
    {
        return new ClassNameValidator();
    }

    protected function createContentParser(): ContentParserInterface
    {
        return new YmlContentParser($this->createYmlParser());
    }

    protected function createYmlParser(): Parser
    {
        return new Parser();
    }

    protected function createFilesystem(): DefinitionFilesystemInterface
    {
        return new DefinitionFilesystem(
            $this->createFinder(),
            $this->getConfig(),
        );
    }

    protected function createFinder(): Finder
    {
        return new Finder();
    }
}
