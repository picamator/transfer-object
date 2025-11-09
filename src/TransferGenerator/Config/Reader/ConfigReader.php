<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Reader;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;

readonly class ConfigReader implements ConfigReaderInterface
{
    public function __construct(
        private ConfigValidatorInterface $validator,
        private ConfigParserInterface $parser,
        private ConfigBuilderInterface $builder,
    ) {
    }

    public function getConfig(string $configPath): ConfigTransfer
    {
        $configTransfer = $this->validateConfigPath($configPath);
        if ($configTransfer !== null) {
            return $configTransfer;
        }

        try {
            $contentTransfer = $this->parser->parseConfig($configPath);
        } catch (YmlParserException $e) {
            return $this->builder->createErrorConfigTransfer($e);
        }

        return $this->validateConfigContent($contentTransfer);
    }

    private function validateConfigContent(ConfigContentTransfer $contentTransfer): ConfigTransfer
    {
        try {
            $validatorTransfer = $this->validator->validateContent($contentTransfer);
        } catch (FilesystemException $e) {
            return $this->builder->createErrorConfigTransfer($e);
        }

        return $this->builder->createConfigTransfer($validatorTransfer, $contentTransfer);
    }

    private function validateConfigPath(string $configPath): ?ConfigTransfer
    {
        try {
            $validatorTransfer = $this->validator->validateFile($configPath);
        } catch (FilesystemException $e) {
            return $this->builder->createErrorConfigTransfer($e);
        }

        if ($validatorTransfer->isValid) {
            return null;
        }

        return $this->builder->createConfigTransfer($validatorTransfer);
    }
}
