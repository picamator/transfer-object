<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class FileSizeValidator implements FileSizeValidatorInterface
{
    use ValidatorMessageTrait;

    private const string UNKNOWN_ERROR_MESSAGE_TEMPLATE = 'Failed to get file size for "%s".';
    private const string MAX_SIZE_ERROR_MESSAGE_TEMPLATE = <<<'TEMPLATE'
File "%s" ("%d" bytes) exceeds the maximum allowed size of "%d" bytes. Please split the file into smaller parts.
TEMPLATE;

    private const int MAX_FILE_SIZE_BYTES = 10_000_000;

    public function validate(string $path): ?ValidatorMessageTransfer
    {
        $fileSize = $this->filesize($path);
        if ($fileSize === false) {
            $errorMessage = sprintf(self::UNKNOWN_ERROR_MESSAGE_TEMPLATE, $path);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        if ($fileSize > self::MAX_FILE_SIZE_BYTES) {
            $errorMessage = sprintf(
                self::MAX_SIZE_ERROR_MESSAGE_TEMPLATE,
                $path,
                $fileSize,
                self::MAX_FILE_SIZE_BYTES
            );

            return $this->createErrorMessageTransfer($errorMessage);
        }

        return null;
    }

    protected function filesize(string $path): int|false
    {
        return @filesize($path);
    }
}
