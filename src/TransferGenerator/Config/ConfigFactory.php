<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use ArrayObject;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoader;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParser;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReader;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\ConfigContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\DefinitionPathConfigContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\RequiredConfigContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\TransferNamespaceConfigContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\File\ConfigFileValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\File\FileExistConfigFileValidator;

readonly class ConfigFactory
{
    use DependencyFactoryTrait;

    public function createConfigLoader(): ConfigLoaderInterface
    {
        return new ConfigLoader(
            $this->createConfigReader(),
        );
    }

    protected function createConfigReader(): ConfigReaderInterface
    {
        return new ConfigReader(
            $this->createConfigParser(),
            $this->createConfigValidator(),
        );
    }

    protected function createConfigValidator(): ConfigValidatorInterface
    {
        return new ConfigValidator(
            $this->createConfigFileValidator(),
            $this->createConfigContentValidators()
        );
    }

    /**
     * @return \ArrayObject<int,ConfigContentValidatorInterface>
     */
    protected function createConfigContentValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createRequiredConfigContentValidator(),
            $this->createDefinitionPathConfigContentValidator(),
            $this->createTransferNamespaceConfigContentValidator(),
        ]);
    }

    protected function createTransferNamespaceConfigContentValidator(): ConfigContentValidatorInterface
    {
        return new TransferNamespaceConfigContentValidator();
    }

    protected function createDefinitionPathConfigContentValidator(): ConfigContentValidatorInterface
    {
        return new DefinitionPathConfigContentValidator($this->createFilesystem());
    }

    protected function createRequiredConfigContentValidator(): ConfigContentValidatorInterface
    {
        return new RequiredConfigContentValidator();
    }

    protected function createConfigFileValidator(): ConfigFileValidatorInterface
    {
        return new FileExistConfigFileValidator($this->createFilesystem());
    }

    protected function createFilesystem(): FilesystemInterface
    {
        return $this->getDependency(DependencyContainer::FILESYSTEM);
    }

    protected function createConfigParser(): ConfigParserInterface
    {
        return new ConfigParser($this->createYmlParser());
    }

    protected function createYmlParser(): YmlParserInterface
    {
        return $this->getDependency(DependencyContainer::YML_PARSER);
    }
}
