<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class ClassNameValidator implements ClassNameValidatorInterface
{
    use VariableValidatorTrait;
    use ValidatorMessageTrait;

    private const string CLASS_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid class name "%s".';

    public function validate(?string $className): ValidatorMessageTransfer
    {
        if ($this->isValidVariable($className)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($className);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(?string $className): string
    {
        return sprintf(self::CLASS_NAME_ERROR_MESSAGE_TEMPLATE, $className ?? '');
    }
}
