<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Reader;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\BulkContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigFileValidatorInterface;

readonly class ConfigReader implements ConfigReaderInterface
{
    use ValidatorTrait;

    public function __construct(
        private ConfigParserInterface $parser,
        private ConfigFileValidatorInterface $fileValidator,
        private BulkContentValidatorInterface $contentValidator,
        private ConfigBuilderInterface $configBuilder,
    ) {
    }

    public function getConfig(string $configPath): ConfigTransfer
    {
        try {
            return $this->handleConfig($configPath);
        } catch (YmlParserException | FilesystemException $e) {
            return $this->configBuilder->createErrorConfigTransfer($e->getMessage());
        }
    }

    private function handleConfig(string $configPath): ConfigTransfer
    {
        $configTransfer = $this->validateConfigFile($configPath);
        if (!$configTransfer->validator->isValid) {
            return $configTransfer;
        }

        return $this->parseConfig($configPath);
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     */
    private function parseConfig(string $configPath): ConfigTransfer
    {
        $contentTransfer = $this->parser->parseConfig($configPath);
        $validatorTransfer = $this->contentValidator->validateContent($contentTransfer);

        return $this->configBuilder->createConfigTransfer($validatorTransfer, $contentTransfer);
    }

    private function validateConfigFile(string $configPath): ConfigTransfer
    {
        $validatorTransfer = $this->fileValidator->validateFile($configPath);

        return $this->configBuilder->createConfigTransfer($validatorTransfer);
    }
}
