<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ValidatorMessageTrait;

readonly class DefinitionPathConfigContentValidator implements ConfigContentValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Definition path "%s" does not exist.';

    public function __construct(
        private FilesystemInterface $filesystem
    ) {
    }

    public function validate(ConfigContentTransfer $configContentTransfer): ValidatorMessageTransfer
    {
        $definitionPath = $configContentTransfer->definitionPath ?? '';
        $isExists = $this->filesystem->exists($definitionPath);

        if (!$isExists) {
            $errorMessage = $this->getErrorMessage($definitionPath);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        return $this->createSuccessMessageTransfer();
    }

    private function getErrorMessage(string $definitionPath): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $definitionPath);
    }
}
