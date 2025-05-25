<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

trait ValidatorTrait
{
    final protected function createErrorValidatorTransfer(string $errorMessage): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = false;

        $validatorTransfer->errorMessages[] = new ValidatorMessageTransfer([
            ValidatorMessageTransfer::IS_VALID => false,
            ValidatorMessageTransfer::ERROR_MESSAGE => $errorMessage,
        ]);

        return $validatorTransfer;
    }

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer> $errorMessages
     */
    final protected function createErrorValidatorWithMessagesTransfer(ArrayObject $errorMessages): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = false;
        $validatorTransfer->errorMessages = $errorMessages;

        return $validatorTransfer;
    }

    final protected function createSuccessValidatorTransfer(): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }
}
