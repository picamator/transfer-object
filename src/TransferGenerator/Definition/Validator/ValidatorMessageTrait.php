<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

trait ValidatorMessageTrait
{
    protected function createErrorMessageTransfer(string $errorMessage): ValidatorMessageTransfer
    {
        $messageTransfer = new ValidatorMessageTransfer();
        $messageTransfer->isValid = false;
        $messageTransfer->errorMessage = $errorMessage;

        return $messageTransfer;
    }

    protected function createSuccessMessageTransfer(): ValidatorMessageTransfer
    {
        $messageTransfer = new ValidatorMessageTransfer();
        $messageTransfer->isValid = true;

        return $messageTransfer;
    }
}
