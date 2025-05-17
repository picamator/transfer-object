<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Reader;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;
use Throwable;

readonly class ConfigReader implements ConfigReaderInterface
{
    use ValidatorTrait;

    public function __construct(
        private ConfigParserInterface $parser,
        private ConfigValidatorInterface $validator,
    ) {
    }

    public function getConfig(string $configPath): ConfigTransfer
    {
        try {
            return $this->handleConfig($configPath);
        } catch (YmlParserException | FilesystemException $e) {
            return $this->createErrorConfigTransfer($e);
        }
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     */
    private function handleConfig(string $configPath): ConfigTransfer
    {
        $validatorTransfer = $this->validator->validateFile($configPath);
        if (!$validatorTransfer->isValid) {
            return $this->createConfigTransfer($validatorTransfer);
        }

        $contentTransfer = $this->parser->parseConfig($configPath);
        $validatorTransfer = $this->validator->validateContent($contentTransfer);

        $configTransfer = $this->createConfigTransfer($validatorTransfer);
        $configTransfer->content = $contentTransfer;

        return $configTransfer;
    }

    private function createConfigTransfer(ValidatorTransfer $validatorTransfer): ConfigTransfer
    {
        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $validatorTransfer;

        return $configTransfer;
    }

    private function createErrorConfigTransfer(Throwable $e): ConfigTransfer
    {
        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $this->createErrorValidatorTransfer($e->getMessage());

        return $configTransfer;
    }
}
