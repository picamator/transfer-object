<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class PathExistValidator implements PathExistValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Path "%s" does not exist.';

    public function __construct(
        private FilesystemInterface $filesystem,
    ) {
    }

    public function validate(string $path): ValidatorMessageTransfer
    {
        if ($this->filesystem->exists($path)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($path);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(string $filePath): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $filePath);
    }
}
