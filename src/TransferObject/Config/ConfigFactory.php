<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

use ArrayObject;
use Picamator\TransferObject\Config\Filesystem\ConfigFilesystem;
use Picamator\TransferObject\Config\Filesystem\ConfigFilesystemInterface;
use Picamator\TransferObject\Config\Loader\ConfigLoader;
use Picamator\TransferObject\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\Config\Parser\FileParserInterface;
use Picamator\TransferObject\Config\Parser\YmlFileParser;
use Picamator\TransferObject\Config\Validator\ConfigValidator;
use Picamator\TransferObject\Config\Validator\ConfigValidatorInterface;
use Picamator\TransferObject\Config\Validator\DefinitionPathConfigValidator;
use Picamator\TransferObject\Config\Validator\RequiredConfigValidator;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Parser;

readonly class ConfigFactory
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
     * @return \ArrayObject<\Picamator\TransferObject\Config\Validator\ConfigValidatorInterface>
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
        return new DefinitionPathConfigValidator($this->createConfigFilesystem());
    }

    protected function createConfigFilesystem(): ConfigFilesystemInterface
    {
        return new ConfigFilesystem($this->createFilesystem());
    }

    protected function createFilesystem(): Filesystem
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
