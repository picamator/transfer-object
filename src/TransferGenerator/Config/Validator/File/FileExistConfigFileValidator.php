<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\File;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Validator\ValidatorMessageTrait;

readonly class FileExistConfigFileValidator implements ConfigFileValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Configuration file "%s" does not exist.';

    public function __construct(
        private FilesystemInterface $filesystem,
    ) {
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function validate(string $filePath): ValidatorMessageTransfer
    {
        if ($this->filesystem->exists($filePath)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($filePath);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(string $filePath): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $filePath);
    }
}
