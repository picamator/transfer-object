<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class PathValidator implements PathValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Path "%s" does not exist.';

    public function __construct(
        private FilesystemInterface $filesystem,
    ) {
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
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
