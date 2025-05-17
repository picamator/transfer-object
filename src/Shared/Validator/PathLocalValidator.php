<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

class PathLocalValidator implements PathLocalValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Path "%s" is not a local one.';

    public function validate(string $path): ValidatorMessageTransfer
    {
        if (stream_is_local($path)) {
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
