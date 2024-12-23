<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader;

use ArrayObject;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Config\Loader\Loader\ConfigLoader;
use Picamator\TransferObject\TransferGenerator\Config\Loader\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\FileParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\YmlFileParser;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\DefinitionPathConfigValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\RequiredConfigValidator;
use Symfony\Component\Yaml\Parser;

readonly class ConfigLoaderFactory
{
    use DependencyFactoryTrait;

    public function createConfigLoader(): ConfigLoaderInterface
    {
        return new ConfigLoader(
            $this->createFileParser(),
            $this->createConfigValidator(),
        );
    }

    protected function createConfigValidator(): ConfigValidatorInterface
    {
        return new ConfigValidator($this->createConfigValidators());
    }

    /**
     * @return \ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface>
     */
    protected function createConfigValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createRequiredConfigValidator(),
            $this->createDefinitionPathConfigValidator(),
        ]);
    }

    protected function createDefinitionPathConfigValidator(): ConfigValidatorInterface
    {
        return new DefinitionPathConfigValidator($this->createFilesystem());
    }

    protected function createFilesystem(): FilesystemInterface
    {
        return $this->getDependency(DependencyContainer::FILESYSTEM);
    }

    protected function createRequiredConfigValidator(): ConfigValidatorInterface
    {
        return new RequiredConfigValidator();
    }

    protected function createFileParser(): FileParserInterface
    {
        return new YmlFileParser($this->createYmlParser());
    }

    protected function createYmlParser(): Parser
    {
        return $this->getDependency(DependencyContainer::YML_PARSER);
    }
}
