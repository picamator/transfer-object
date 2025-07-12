<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Reader;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
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
        try {
            return $this->handleConfig($configPath);
        } catch (YmlParserException | FilesystemException $e) {
            return $this->builder->createErrorConfigTransfer($e->getMessage());
        }
    }

    private function handleConfig(string $configPath): ConfigTransfer
    {
        $validatorTransfer = $this->validator->validateFile($configPath);
        if (!$validatorTransfer->isValid) {
            return $this->builder->createConfigTransfer($validatorTransfer);
        }

        $contentTransfer = $this->parser->parseConfig($configPath);
        $validatorTransfer = $this->validator->validateContent($contentTransfer);

        return $this->builder->createConfigTransfer($validatorTransfer, $contentTransfer);
    }
}
