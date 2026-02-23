<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;

readonly class FileSizeValidator implements FileSizeValidatorInterface
{
    use ValidatorMessageTrait;

    private const string UNKNOWN_ERROR_MESSAGE_TEMPLATE = 'Failed to get file size for "%s".';
    private const string MAX_SIZE_ERROR_MESSAGE_TEMPLATE = <<<'TEMPLATE'
File "%s" ("%d" bytes) exceeds the maximum allowed size of "%d" bytes. Please split the file into smaller parts.
TEMPLATE;

    private const int MAX_FILE_SIZE_BYTE_MULTIPLIER = 1_000_000;

    public function __construct(private EnvironmentReaderInterface $environmentReader)
    {
    }

    public function validate(string $path): ?ValidatorMessageTransfer
    {
        $fileSize = $this->filesize($path);
        if ($fileSize === false) {
            $errorMessage = sprintf(self::UNKNOWN_ERROR_MESSAGE_TEMPLATE, $path);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        $maxFileSizeBytes = $this->getMaxFileSizeBytes();

        if ($fileSize > $maxFileSizeBytes) {
            $errorMessage = sprintf(
                self::MAX_SIZE_ERROR_MESSAGE_TEMPLATE,
                $path,
                $fileSize,
                $maxFileSizeBytes,
            );

            return $this->createErrorMessageTransfer($errorMessage);
        }

        return null;
    }

    private function getMaxFileSizeBytes(): int
    {
        return (int)$this->environmentReader->getMaxFileSizeMegabytes() * self::MAX_FILE_SIZE_BYTE_MULTIPLIER;
    }

    protected function filesize(string $path): int|false
    {
        return @filesize($path);
    }
}
