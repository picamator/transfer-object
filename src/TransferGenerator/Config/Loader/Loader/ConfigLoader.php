<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader\Loader;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigContainer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\Reader\ConfigReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;

readonly class ConfigLoader implements ConfigLoaderInterface
{
    private const string CONFIG_FILE_DOS_NOT_EXIST_ERROR_MESSAGE = 'Config file "%s" does not exist.';

    public function __construct(
        private FilesystemInterface $filesystem,
        private ConfigReaderInterface $reader,
        private ConfigValidatorInterface $validator,
    ) {
    }

    public function loadConfig(string $configPath): ValidatorMessageTransfer
    {
        if (!$this->filesystem->exists($configPath)) {
            return $this->createErrorMessageTransfer($configPath);
        }

        $configTransfer = $this->reader->getConfig($configPath);
        $messageTransfer = $this->validator->validate($configTransfer);

        if ($messageTransfer->isValid) {
            ConfigContainer::loadConfig($configTransfer);
        }

        return $messageTransfer;
    }

    private function createErrorMessageTransfer(string $configPath): ValidatorMessageTransfer
    {
        $messageTransfer = new ValidatorMessageTransfer();
        $messageTransfer->errorMessage = sprintf(self::CONFIG_FILE_DOS_NOT_EXIST_ERROR_MESSAGE, $configPath);
        $messageTransfer->isValid = false;

        return $messageTransfer;
    }
}
