<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use ArrayObject;
use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoader;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigBuilder;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigContentBuilder;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigContentBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParser;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReader;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\BulkContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\BulkContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigFileValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigFileValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\ContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\DefinitionPathContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\RequiredContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\TransferNamespaceContentValidator;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\TransferPathContentValidator;

class ConfigFactory
{
    use SharedFactoryTrait;

    public function createConfigLoader(): ConfigLoaderInterface
    {
        return $this->getCached(
            key: 'transfer-generator:ConfigLoader',
            factory: fn(): ConfigLoaderInterface => new ConfigLoader($this->createConfigReader()),
        );
    }

    protected function createConfigReader(): ConfigReaderInterface
    {
        return new ConfigReader(
            $this->createConfigValidator(),
            $this->createConfigParser(),
            $this->createConfigBuilder(),
        );
    }

    protected function createConfigBuilder(): ConfigBuilderInterface
    {
        return new ConfigBuilder();
    }

    protected function createConfigValidator(): ConfigValidatorInterface
    {
        return new ConfigValidator(
            $this->createConfigFileValidator(),
            $this->createBulkContentValidator(),
        );
    }

    protected function createBulkContentValidator(): BulkContentValidatorInterface
    {
        return new BulkContentValidator(
            $this->createConfigContentValidators(),
        );
    }

    protected function createConfigFileValidator(): ConfigFileValidatorInterface
    {
        return new ConfigFileValidator(
            $this->createPathExistValidator(),
        );
    }

    /**
     * @return \ArrayObject<int,ContentValidatorInterface>
     */
    protected function createConfigContentValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createRequiredConfigContentValidator(),
            $this->createDefinitionPathConfigContentValidator(),
            $this->createTransferPathConfigContentValidator(),
            $this->createTransferNamespaceConfigContentValidator(),
        ]);
    }

    protected function createTransferNamespaceConfigContentValidator(): ContentValidatorInterface
    {
        return new TransferNamespaceContentValidator();
    }

    protected function createTransferPathConfigContentValidator(): ContentValidatorInterface
    {
        return new TransferPathContentValidator(
            $this->createPathLocalValidator(),
        );
    }

    protected function createDefinitionPathConfigContentValidator(): ContentValidatorInterface
    {
        return new DefinitionPathContentValidator(
            $this->createPathLocalValidator(),
            $this->createPathExistValidator(),
        );
    }

    protected function createRequiredConfigContentValidator(): ContentValidatorInterface
    {
        return new RequiredContentValidator();
    }

    protected function createConfigParser(): ConfigParserInterface
    {
        /** @var ConfigParserInterface $configParser */
        $configParser = $this->getLazyGhost(
            className: ConfigParser::class,
            initializer: function (ConfigParser $ghost): void {
                $ghost->__construct(
                    $this->createYmlParser(),
                    $this->createConfigContentBuilder(),
                );
            }
        );

        return $configParser;
    }

    protected function createConfigContentBuilder(): ConfigContentBuilderInterface
    {
        return new ConfigContentBuilder($this->createEnvironmentReader());
    }
}
