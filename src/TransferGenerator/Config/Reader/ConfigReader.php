<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Reader;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ConfigValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;
use Throwable;

readonly class ConfigReader implements ConfigReaderInterface
{
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
        if (!$validatorTransfer->isValid) {
            return $this->createConfigTransfer($validatorTransfer);
        }

        $configTransfer = $this->createConfigTransfer($validatorTransfer);
        $configTransfer->content = $contentTransfer;

        return $configTransfer;
    }

    private function createConfigTransfer(ConfigValidatorTransfer $validatorTransfer): ConfigTransfer
    {
        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $validatorTransfer;

        return $configTransfer;
    }

    private function createErrorConfigTransfer(Throwable $e): ConfigTransfer
    {
        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = new ConfigValidatorTransfer();

        $configTransfer->validator->isValid = false;
        $configTransfer->validator->errorMessages[] = new ValidatorMessageTransfer()
            ->fromArray([
                ValidatorMessageTransfer::IS_VALID => false,
                ValidatorMessageTransfer::ERROR_MESSAGE => $e->getMessage(),
            ]);

        return $configTransfer;
    }
}
