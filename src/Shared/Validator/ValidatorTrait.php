<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

trait ValidatorTrait
{
    final protected function createErrorValidatorTransfer(?string $errorMessage = null): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = false;

        if ($errorMessage === null) {
            return $validatorTransfer;
        }

        $validatorTransfer->errorMessages[] = new ValidatorMessageTransfer([
            ValidatorMessageTransfer::IS_VALID_PROP => false,
            ValidatorMessageTransfer::ERROR_MESSAGE_PROP => $errorMessage,
        ]);

        return $validatorTransfer;
    }

    final protected function createSuccessValidatorTransfer(): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }
}
