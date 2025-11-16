<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

trait ValidatorMessageTrait
{
    final protected function createErrorMessageTransfer(string $errorMessage): ValidatorMessageTransfer
    {
        return new ValidatorMessageTransfer([
            ValidatorMessageTransfer::IS_VALID_PROP => false,
            ValidatorMessageTransfer::ERROR_MESSAGE_PROP => $errorMessage,
        ]);
    }
}
