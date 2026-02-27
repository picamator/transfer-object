<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

readonly class HashFileNameContentValidator implements ContentValidatorInterface
{
    use ValidatorMessageTrait;

    private const string HASH_FILE_NAME_REGEX = '#^[a-zA-Z0-9._-]+\\.csv$#';

    private const string ERROR_MESSAGE_TEMPLATE = 'Invalid configuration hash file name "%s". Expected format: '
        . self::HASH_FILE_NAME_REGEX;

    public function validate(ConfigContentTransfer $configContentTransfer): ?ValidatorMessageTransfer
    {
        $hashFileName = $configContentTransfer->hashFileName;
        if (preg_match(self::HASH_FILE_NAME_REGEX, $hashFileName) === 1) {
            return null;
        }

        $errorMessage = $this->getErrorMessage($hashFileName);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(string $hashFileName): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $hashFileName);
    }
}
