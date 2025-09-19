<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\PathExistValidatorInterface;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;

readonly class ConfigFileValidator implements ConfigFileValidatorInterface
{
    use ValidatorTrait;

    public function __construct(
        private PathExistValidatorInterface $pathValidator,
    ) {
    }

    public function validateFile(string $filePath): ValidatorTransfer
    {
        $messageTransfer = $this->pathValidator->validate($filePath);

        if ($messageTransfer->isValid) {
            return $this->createSuccessValidatorTransfer();
        }

        $validatorTransfer = $this->createErrorValidatorTransfer();
        $validatorTransfer->errorMessages[] = $messageTransfer;

        return $validatorTransfer;
    }
}
