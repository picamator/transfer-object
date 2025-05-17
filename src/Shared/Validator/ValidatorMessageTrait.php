<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

trait ValidatorMessageTrait
{
    private static ?ValidatorMessageTransfer $successMessageCache = null;

    final protected function createErrorMessageTransfer(string $errorMessage): ValidatorMessageTransfer
    {
        return new ValidatorMessageTransfer([
            ValidatorMessageTransfer::IS_VALID => false,
            ValidatorMessageTransfer::ERROR_MESSAGE => $errorMessage,
        ]);
    }

    final protected function createSuccessMessageTransfer(): ValidatorMessageTransfer
    {
        return self::$successMessageCache ??= new ValidatorMessageTransfer([
            ValidatorMessageTransfer::IS_VALID => true,
            ValidatorMessageTransfer::ERROR_MESSAGE => '',
        ]);
    }
}
